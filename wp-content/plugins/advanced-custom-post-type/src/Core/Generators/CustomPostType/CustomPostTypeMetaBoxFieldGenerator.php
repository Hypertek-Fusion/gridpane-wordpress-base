<?php

namespace ACPT\Core\Generators\CustomPostType;

use ACPT\Constants\MetaTypes;
use ACPT\Core\Generators\Meta\Fields\AbstractField;
use ACPT\Core\Models\Meta\MetaFieldModel;

class CustomPostTypeMetaBoxFieldGenerator
{
    /**
     * @param int    $postId
     * @param MetaFieldModel $metaField
     *
     * @return AbstractField
     * @throws \Exception
     */
    public static function generate(MetaFieldModel $metaField, $postId = null)
    {
	    return self::getCustomPostTypeField($metaField, $postId);
    }

    /**
     * @param int    $postId
     * @param MetaFieldModel $metaField
     *
     * @return AbstractField
     */
    private static function getCustomPostTypeField(MetaFieldModel $metaField, $postId = null): ?AbstractField
    {
        $className = 'ACPT\\Core\\Generators\\Meta\\Fields\\'.$metaField->getType().'Field';

	    if(class_exists($className)){
	    	/** @var AbstractField $instance */
	    	$instance = new $className($metaField, MetaTypes::CUSTOM_POST_TYPE, $postId);

		    return $instance;
	    }

        return null;
    }
}
