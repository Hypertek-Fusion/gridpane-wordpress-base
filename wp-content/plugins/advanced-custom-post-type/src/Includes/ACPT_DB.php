<?php

namespace ACPT\Includes;

use ACPT\Core\Helper\Strings;
use ACPT\Core\Helper\Uuid;
use ACPT\Core\Models\CustomPostType\CustomPostTypeModel;
use ACPT\Core\Models\Taxonomy\TaxonomyModel;
use ACPT\Core\Repository\CustomPostTypeRepository;
use ACPT\Core\Repository\TaxonomyRepository;
use ACPT\Utils\ExportCode\DBTool;
use ACPT\Utils\PHP\CallingClass;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;

/**
 * This class handles DB interactions.
 *
 * @since      1.0.0
 * @package    advanced-custom-post-type
 * @subpackage advanced-custom-post-type/includes
 * @author     Mauro Cassani <maurocassani1978@gmail.com>
 */
class ACPT_DB
{
    /**
     * Table names
     */
    const TABLE_API_KEYS = 'acpt_api_key';
    const TABLE_CUSTOM_POST_TYPE = 'acpt_custom_post_type';
    const TABLE_CUSTOM_POST_TYPE_META_BOX = 'acpt_custom_post_type_meta_box';
    const TABLE_CUSTOM_POST_TYPE_FIELD = 'acpt_custom_post_type_field';
    const TABLE_CUSTOM_POST_TYPE_ADVANCED_OPTION = 'acpt_custom_post_type_advanced_option';
    const TABLE_CUSTOM_POST_TYPE_OPTION = 'acpt_custom_post_type_option';
    const TABLE_CUSTOM_POST_TYPE_VISIBILITY = 'acpt_custom_post_type_visibility';
    const TABLE_CUSTOM_POST_TYPE_RELATION = 'acpt_custom_post_type_relation';
    const TABLE_CUSTOM_POST_TYPE_BLOCK = 'acpt_custom_post_type_block';
    const TABLE_CUSTOM_POST_TYPE_IMPORT = 'acpt_custom_post_type_import';
    const TABLE_CUSTOM_POST_TEMPLATE = 'acpt_custom_post_template';
	const TABLE_OPTION_PAGE = 'acpt_option_page';
	const TABLE_OPTION_PAGE_META_BOX = 'acpt_option_page_meta_box';
    const TABLE_TAXONOMY = 'acpt_taxonomy';
    const TABLE_TAXONOMY_META_BOX = 'acpt_taxonomy_meta_box';
    const TABLE_TAXONOMY_PIVOT = 'acpt_taxonomy_pivot';
    const TABLE_SETTINGS = 'acpt_settings';
    const TABLE_VALIDATION_RULE = 'acpt_validation_rules';
    const TABLE_VALIDATION_RULE_FIELD_PIVOT = 'acpt_validation_rule_field_pivot';
    const TABLE_WOOCOMMERCE_PRODUCT_DATA = 'acpt_woocommerce_product_data';
    const TABLE_WOOCOMMERCE_PRODUCT_DATA_FIELD = 'acpt_woocommerce_product_data_field';
    const TABLE_WOOCOMMERCE_PRODUCT_DATA_OPTION = 'acpt_woocommerce_product_data_option';
    const TABLE_USER_META_BOX     = 'acpt_user_meta_box';
    const TABLE_USER_META_FIELD        = 'acpt_user_field';
    const TABLE_USER_META_FIELD_OPTION = 'acpt_user_field_option';

	const TABLE_BELONG = 'acpt_belong';
	const TABLE_META_GROUP_BELONG = 'acpt_group_belong';
	const TABLE_META_GROUP = 'acpt_meta_group';
	const TABLE_META_BOX = 'acpt_meta_box';
	const TABLE_META_FIELD = 'acpt_meta_field';
	const TABLE_META_ADVANCED_OPTION = 'acpt_meta_advanced_option';
	const TABLE_META_OPTION = 'acpt_meta_option';
	const TABLE_META_VISIBILITY = 'acpt_meta_visibility';
	const TABLE_META_RELATION = 'acpt_meta_relation';
	const TABLE_META_BLOCK = 'acpt_meta_block';

	const TABLE_TEMPLATE = 'acpt_template';
	const TABLE_TEMPLATE_BELONG = 'acpt_template_belong';

	const TABLE_FORM = 'acpt_form';
	const TABLE_FORM_METADATA = 'acpt_form_metadata';
	const TABLE_FORM_FIELD = 'acpt_form_field';
	const TABLE_FORM_SUBMISSION = 'acpt_form_submission';
	const TABLE_VALIDATION_RULE_FORM_FIELD_PIVOT = 'acpt_validation_rule_form_field_pivot';

	const TABLE_DATASET = 'acpt_dataset';
	const TABLE_DATASET_ITEM = 'acpt_dataset_item';

	const TABLE_PERMISSION = 'acpt_permission';

	/**
	 * @var ExtendedCacheItemPoolInterface
	 */
    private static ?ExtendedCacheItemPoolInterface $cache = null;

	/**
	 * @param ExtendedCacheItemPoolInterface $cache
	 */
    public static function injectCache(ExtendedCacheItemPoolInterface $cache)
    {
    	self::$cache = $cache;
    }

	/**
	 * Return the correct charset collation
	 *
	 * @return string
	 */
	public static function getCharsetCollation()
	{
		global $wpdb;

		$charset_collate = "";
		$collation = $wpdb->get_row("SHOW FULL COLUMNS FROM {$wpdb->posts} WHERE field = 'post_content'");

		if(isset($collation->Collation)) {
			$charset = explode('_', $collation->Collation);

			if(is_array($charset) && count($charset) > 1) {
				$charset = $charset[0];
				$charset_collate = "DEFAULT CHARACTER SET {$charset} COLLATE {$collation->Collation}";
			}
		}

		if(empty($charset_collate)) { $charset_collate = $wpdb->get_charset_collate(); }

		return $charset_collate;
	}

    /**
     * =============================================================
     * SCHEMA
     * =============================================================
     */

    /**
     * check if schema exists
     *
     * @since    1.0.1
     * @return bool
     */
    public static function checkIfSchemaExists()
    {
        try {
            $sql = "SELECT id FROM `".self::prefixedTableName(self::TABLE_CUSTOM_POST_TYPE)."` LIMIT 1;";
            self::executeQueryOrThrowException($sql);

            return true;
        } catch (\Exception $exception){
            return false;
        }
    }

    /**
     * @param $newVersion
     * @param null $oldVersion
     * @throws \Exception
     */
    public static function createSchema($newVersion, $oldVersion = null)
    {
        $createSchema = ACPT_Schema_Manager::up($newVersion, $oldVersion);

        if(!$createSchema){
	        // in case of failure, try to repair
	        $issues = ACPT_DB_Tools::healthCheck();

	        if(!empty($issues)){
		        ACPT_DB_Tools::repair($issues);
	        }

	        $issuesAfterRepair = ACPT_DB_Tools::healthCheck();

	        if(!empty($issuesAfterRepair)){
		        echo esc_html("Error during creation of schema");
		        die();
	        }
        }
    }

    /**
     * destroy schema
     *
     * @since    1.0.0
     */
    public static function destroySchema()
    {
        $destroySchema = ACPT_Schema_Manager::down();

        if(!$destroySchema){
            echo esc_html($destroySchema);
            die();
        }
    }

    /**
     * Sync data with native custom post types and taxonomies
     *
     * @throws \Exception
     * @since    1.0.0
     */
    public static function sync()
    {
        if(ACPT_DB::checkIfSchemaExists()){
            self::createNativePostTypes();
            self::createNativeTaxonomies();
        }
    }

    /**
     * Save post and page native CPT
     *
     * @throws \Exception
     */
    private static function createNativePostTypes()
    {
        $pageSettings = [];
        $postSettings = [];

        // WPGraphQL
        if(is_plugin_active( 'wp-graphql/wp-graphql.php' )){
            $pageSettings['show_in_graphql'] = true;
            $pageSettings['graphql_single_name'] = 'page';
            $pageSettings['graphql_plural_name'] = 'pages';

            $postSettings['show_in_graphql'] = true;
            $postSettings['graphql_single_name'] = 'post';
            $postSettings['graphql_plural_name'] = 'posts';
        }

        $postModel =  CustomPostTypeModel::hydrateFromArray([
                'id' => Uuid::v4(),
                'name' => 'post',
                'singular' => 'Post',
                'plural' => 'Posts',
                'icon' => 'admin-post',
                'native' => true,
                'supports' => [],
                'labels' => [],
                'settings' => $postSettings,
        ]);

        $pageModel =  CustomPostTypeModel::hydrateFromArray([
                'id' => Uuid::v4(),
                'name' => 'page',
                'singular' => 'Page',
                'plural' => 'Pages',
                'icon' => 'admin-page',
                'native' => true,
                'supports' => [],
                'labels' => [],
                'settings' => $pageSettings,
        ]);

        CustomPostTypeRepository::save($postModel);
        CustomPostTypeRepository::save($pageModel);
    }

    /**
     * Save native taxonomies
     *
     * @throws \Exception
     */
    private static function createNativeTaxonomies()
    {
        $idCat = Uuid::v4();
        $categoryModel =  TaxonomyModel::hydrateFromArray([
            'id' => $idCat,
            'slug' => 'category',
            'singular' => 'Category',
            'plural' => 'Categories',
            'native' => true,
            'labels' => [],
            'settings' => [
                'hierarchical' => true
            ],
        ]);

        $idTag = Uuid::v4();
        $tagModel =  TaxonomyModel::hydrateFromArray([
            'id' => $idTag,
            'slug' => 'post_tag',
            'singular' => 'Tag',
            'plural' => 'Tags',
            'native' => true,
            'labels' => [],
            'settings' => [
                'hierarchical' => false
            ],
        ]);

        TaxonomyRepository::save($categoryModel);
        TaxonomyRepository::save($tagModel);

        $post = CustomPostTypeRepository::get([
            'postType' => 'post'
        ])[0];

        if($post !== null and $idCat !== null and $idTag !== null){
            TaxonomyRepository::assocToPostType($post->getId(), $idCat);
            TaxonomyRepository::assocToPostType($post->getId(), $idTag);
        }
    }

    /**
     * =============================================================
     * GENERAL PURPOSE METHODS
     * =============================================================
     */

    /**
     * @throws \Exception
     */
    public static function startTransaction()
    {
        self::executeQueryOrThrowException('START TRANSACTION');
    }

    /**
     * @throws \Exception
     */
    public static function rollbackTransaction()
    {
        self::executeQueryOrThrowException('ROLLBACK');
    }

    /**
     * @throws \Exception
     */
    public static function commitTransaction()
    {
        self::executeQueryOrThrowException('COMMIT');
    }

    /**
     * Executes a query (and flush the cache).
     *
     * @param string $sql
     * @param array  $args
     *
     * @throws \Exception
     */
    public static function executeQueryOrThrowException($sql, array $args = [])
    {
        global $wpdb;

        if ( false === $wpdb->query(self::prepare($sql, $args))) {
            throw new \Exception($wpdb->last_error);
        }
    }

	/**
	 * @param $sql
	 * @param array $args
	 * @param int $cacheTtl (2h default)
	 *
	 * @return array|mixed|object|null
	 */
	public static function getResults($sql, array $args = [], $cacheTtl = 7200)
	{
		global $wpdb;
		$preparedQuery = self::prepare($sql, $args);

		if(self::$cache){
			try {
				$cacheKey = md5(Strings::removeAllExtraSpaces($preparedQuery));
				$cachedElement = self::$cache->getItem($cacheKey);

				if (!$cachedElement->isHit()) {
					$tag = md5(CallingClass::get());
					$data = $wpdb->get_results($preparedQuery);
					$cachedElement->addTag($tag)->set($data)->expiresAfter($cacheTtl);
					self::$cache->save($cachedElement);
				}

				return $cachedElement->get();

			} catch ( InvalidArgumentException $e ) {
				return $wpdb->get_results($preparedQuery);
			}
		}

		return $wpdb->get_results($preparedQuery);
	}

	/**
	 * @param $tag
	 */
	public static function invalidateCacheTag($tag)
	{
		if(self::$cache){
			self::$cache->deleteItemsByTag(md5($tag));
		}
	}

	/**
	 * @return bool
	 */
	public static function flushCache()
	{
		if(self::$cache){
			return self::$cache->clear();
		}
	}

    /**
     * Get the prepared sql query
     *
     * For more info refer to:
     * https://developer.wordpress.org/reference/classes/wpdb/prepare/
     *
     * @param $query
     * @param $args
     *
     * @return string
     */
    private static function prepare($query, array $args = [])
    {
        global $wpdb;

        $preparedQuery = (!empty($args)) ? $wpdb->prepare( $query, $args ) : $query;

        return str_ireplace( "'NULL'", "NULL", $preparedQuery );
    }

    /**
     * Get the table prefix
     *
     * @return mixed
     */
    public static function prefix()
    {
        global $wpdb;

        return $wpdb->prefix;
    }

    /**
     * @param $table
     *
     * @return string
     */
    public static function prefixedTableName($table)
    {
        if(self::prefix() == ''){
            return $table;
        }

        return self::prefix().$table;
    }

	/**
	 * @param $table
	 *
	 * @return bool
	 */
	public static function tableIsEmpty($table)
	{
		if(!self::tableExists($table)){
			return false;
		}

		global $wpdb;

		$results =  $wpdb->get_results( 'SELECT count(id) as c from '.  $table );

		if(empty($results)){
			return false;
		}

		return $results[0]->c == 0;
	}

	/**
	 * @param $table
	 *
	 * @return bool
	 */
    public static function tableExists($table)
    {
	    global $wpdb;

	    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table ) );

	    if ( ! $wpdb->get_var( $query ) == $table ) {
		    return false;
	    }

	    return true;
    }

    /**
     * @param $table
     * @param $column
     *
     * @return bool
     */
    public static function checkIfColumnExistsInTable($table, $column)
    {
        global $wpdb;

        $exists = false;
        $rows = $wpdb->get_results(  "SHOW COLUMNS FROM `".$table."`  "  );

        foreach ($rows as $row){
            if($column === $row->Field){
                return true;
            }
        }

        return $exists;
    }
}