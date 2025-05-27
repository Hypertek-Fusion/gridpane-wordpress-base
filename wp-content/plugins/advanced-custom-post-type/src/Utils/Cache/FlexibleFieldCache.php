<?php

namespace ACPT\Utils\Cache;

use ACPT\Core\Helper\Strings;
use ACPT\Core\Repository\MetaRepository;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;

class FlexibleFieldCache
{
    const CACHE_TTL = 3600; // 1 hour

    /**
     * @var bool
     */
    private $cacheEnabled = false;

    /**
     * @var ExtendedCacheItemPoolInterface
     */
    private $cache;

    /**
     * RepeaterFieldCache constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if(!function_exists(isACPTCacheEnabled())){
            require_once(ACPT_PLUGIN_DIR_PATH . '/functions/bootstrap.php');
        }

        if(isACPTCacheEnabled()){
            $this->cacheEnabled = true;
            $this->cache = cacheACPTInstance();
        }
    }

    /**
     * @param $blockId
     * @param $mediaType
     * @param $parentName
     * @param $elementIndex
     * @param $blockIndex
     * @param $realBlockId
     * @return mixed|string|string[]|null
     */
    public function get(
        $blockId,
        $mediaType,
        $parentName,
        $elementIndex,
        $blockIndex,
        $realBlockId
    )
    {
        if($this->cacheEnabled === false){
            return null;
        }

        try {
            $cacheKey = md5($blockId."-".$mediaType);
            $cachedElement = $this->cache->getItem($cacheKey);

            if (!$cachedElement->isHit()) {
                return null;
            }

            $elementId = 'element-'.rand(999999,111111);

            $template = $cachedElement->get();
            $template = str_replace("{blockIndex}", $blockIndex, $template);
            $template = str_replace("{elementIndex}", $elementIndex, $template);
            $template = str_replace("{parentName}", $parentName, $template);
            $template = str_replace("{realBlockId}", $realBlockId, $template);
            $template = str_replace("{sortableLiId}", "sortable-li-".$blockId."-".$blockIndex, $template);
            $template = str_replace("{element-id}", $elementId, $template);

            $id = Strings::generateRandomId();

            $template = str_replace('{qr_code_value}', 'qr_code_value_'. $id, $template);
            $template = str_replace('{acpt-qr-code-wrapper}', 'acpt-qr-code-wrapper-'.$id, $template);
            $template = str_replace('{acpt-qr-code}', 'acpt-qr-code-'.$id, $template);

            return $template;

        } catch (\Exception $exception){
            return null;
        }
    }

    /**
     * Save a flexible field template into cache
     *
     * @param $fields
     * @param $blockId
     * @param $mediaType
     * @param $parentName
     * @param $elementIndex
     * @param $blockIndex
     * @param $realBlockId
     */
    public function save(
        $fields,
        $blockId,
        $mediaType,
        $parentName,
        $elementIndex,
        $blockIndex,
        $realBlockId
    )
    {
        if($this->cacheEnabled === false){
            return;
        }

        try {
            $replaced = str_replace($parentName, '{parentName}', $fields);
            $replaced = str_replace($realBlockId, '{realBlockId}', $replaced);
            $replaced = str_replace("sortable-li-".$blockId."-".$blockIndex, '{sortableLiId}', $replaced);
            $replaced = str_replace("{parentName}[blocks][".$blockIndex."]", "{parentName}[blocks][{blockIndex}]", $replaced);
            $replaced = str_replace("[".$elementIndex."]", "[{elementIndex}]", $replaced);
            $replaced = preg_replace('/element-(\d+)/', '{element-id}', $replaced);
            $replaced = preg_replace('/qr_code_value_id_(\d+)/', '{qr_code_value}', $replaced);
            $replaced = preg_replace('/acpt-qr-code-wrapper-id_(\d+)/', '{acpt-qr-code-wrapper}', $replaced);
            $replaced = preg_replace('/acpt-qr-code-id_(\d+)/', '{acpt-qr-code}', $replaced);

            $cacheKey = md5($blockId."-".$mediaType);
            $cacheTtl = 3600; // 1 hour

            $cachedElement = $this->cache->getItem($cacheKey);
            $tag = MetaRepository::class;
            $cachedElement->addTag($tag)->set($replaced)->expiresAfter($cacheTtl);
            $this->cache->save($cachedElement);

        } catch (\Exception $exception){}
    }
}