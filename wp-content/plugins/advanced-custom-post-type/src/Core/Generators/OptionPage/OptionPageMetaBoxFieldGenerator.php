<?php

namespace ACPT\Core\Generators\OptionPage;

use ACPT\Constants\MetaTypes;
use ACPT\Core\Generators\AbstractGenerator;
use ACPT\Core\Generators\Meta\Fields\AbstractField;
use ACPT\Core\Models\Meta\MetaFieldModel;

/**
 * *************************************************
 * OptionPageMetaBoxGenerator class
 * *************************************************
 *
 * @author Mauro Cassani
 * @link https://github.com/mauretto78/
 */
class OptionPageMetaBoxFieldGenerator extends AbstractGenerator
{
	/**
	 * @var MetaFieldModel
	 */
	private MetaFieldModel $fieldModel;

	/**
	 * @var string
	 */
	private $optionPageSlug;

	/**
	 * @var array
	 */
	private array $permissions;

	/**
	 * OptionPageMetaBoxFieldGenerator constructor.
	 *
	 * @param MetaFieldModel $fieldModel
	 * @param $optionPageSlug
	 * @param array $permissions
	 */
	public function __construct(MetaFieldModel $fieldModel, $optionPageSlug, $permissions = [])
	{
		$this->fieldModel = $fieldModel;
		$this->optionPageSlug = $optionPageSlug;
		$this->permissions = $permissions;
	}

	/**
	 * @return AbstractField|null
	 */
	public function generate()
	{
		return $this->getOptionPageField();
	}

	/**
	 * @return AbstractField|null
	 */
	private function getOptionPageField()
	{
		$className = 'ACPT\\Core\\Generators\\Meta\\Fields\\'.$this->fieldModel->getType().'Field';

		if(class_exists($className)){
			/** @var AbstractField $instance */
			$instance = new $className($this->fieldModel, MetaTypes::OPTION_PAGE, $this->optionPageSlug);
			$instance->setExternalPermissions($this->permissions);

			return $instance;
		}

		return null;
	}
}