<?php

namespace ACPT\Core\Generators\Taxonomy;

use ACPT\Constants\MetaTypes;
use ACPT\Core\Generators\Meta\Fields\AbstractField;
use ACPT\Core\Models\Meta\MetaFieldModel;

/**
 * *************************************************
 * TaxonomyMetaBoxFieldGenerator class
 * *************************************************
 *
 * @author Mauro Cassani
 * @link https://github.com/mauretto78/
 */
class TaxonomyMetaBoxFieldGenerator
{
    /**
     * @var MetaFieldModel
     */
    private MetaFieldModel $metaFieldModel;

    /**
     * @var
     */
    private $termId;

    /**
     * TaxonomyMetaBoxFieldGenerator constructor.
     * @param MetaFieldModel $metaFieldModel
     * @param null $termId
     */
    public function __construct(MetaFieldModel $metaFieldModel, $termId)
    {
        $this->metaFieldModel = $metaFieldModel;
        $this->termId = $termId;
    }

	/**
	 * @return AbstractField|null
	 */
    public function generate()
    {
	    return self::getTaxonomyField();
    }

	/**
	 * @return AbstractField|null
	 */
    private function getTaxonomyField()
    {
        $className = 'ACPT\\Core\\Generators\\Meta\\Fields\\'.$this->metaFieldModel->getType().'Field';

	    if(class_exists($className)){
		    /** @var AbstractField $instance */
		    $instance = new $className($this->metaFieldModel, MetaTypes::TAXONOMY, $this->termId);

		    return $instance;
	    }

	    return null;
    }
}
