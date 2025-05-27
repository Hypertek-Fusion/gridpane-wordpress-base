<?php

namespace ACPT\Utils\Cache;

use ACPT\Core\Helper\Strings;
use ACPT\Core\Repository\MetaRepository;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;

class RepeaterFieldCache
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
     * @param $id
     * @param $mediaType
     * @param $parentIndex
     * @param $parentName
     * @param $index
     * @return mixed|null
     */
    public function get(
        $id,
        $mediaType,
        $parentIndex,
        $parentName,
        $index
    )
    {
        if($this->cacheEnabled === false){
            return null;
        }

        try {
            $cacheKey = md5($id."-".$mediaType);
            $cachedElement = $this->cache->getItem($cacheKey);

            if (!$cachedElement->isHit()) {
                return null;
            }

            $elementId = 'element-'.rand(999999,111111);

            $template = $cachedElement->get();
            $template = str_replace("{index}", $index, $template);
            $template = str_replace("{parentIndex}", $parentIndex, $template);
            $template = str_replace("{parentName}", $parentName, $template);
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
     * Save a repeater field template into cache
     *
     * @param $fields
     * @param $id
     * @param $mediaType
     * @param $parentIndex
     * @param $parentName
     * @param $index
     */
    public function save(
        $fields,
        $id,
        $mediaType,
        $parentIndex,
        $parentName,
        $index
    )
    {
        if($this->cacheEnabled === false){
            return;
        }

        try {
            $replaced = str_replace($parentName, '{parentName}', $fields);
            $replaced = preg_replace('/'.$parentIndex.'/', '{parentIndex}', $replaced);
            $replaced = str_replace("[".$index."]", "[{index}]", $replaced);
            $replaced = str_replace("#".$index, '#{index}', $replaced);
            $replaced = preg_replace('/element-(\d+)/', '{element-id}', $replaced);
            $replaced = preg_replace('/qr_code_value_id_(\d+)/', '{qr_code_value}', $replaced);
            $replaced = preg_replace('/acpt-qr-code-wrapper-id_(\d+)/', '{acpt-qr-code-wrapper}', $replaced);
            $replaced = preg_replace('/acpt-qr-code-id_(\d+)/', '{acpt-qr-code}', $replaced);

            $cacheKey = md5($id."-".$mediaType);

            $cachedElement = $this->cache->getItem($cacheKey);
            $tag = MetaRepository::class;
            $cachedElement->addTag($tag)->set($replaced)->expiresAfter(self::CACHE_TTL);
            $this->cache->save($cachedElement);

        } catch (\Exception $exception){}
    }
}