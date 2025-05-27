<?php

namespace ACPT\Integrations\Breakdance\Provider\Fields;

use ACPT\Core\Generators\Meta\TableFieldGenerator;
use ACPT\Core\Helper\Strings;
use ACPT\Core\Models\Meta\MetaFieldModel;
use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class ACPTTableField extends StringField implements ACPTFieldInterface
{
	/**
	 * @var MetaFieldModel
	 */
	protected MetaFieldModel $fieldModel;

    /**
     * @var null
     */
    protected $belongsTo;

    /**
     * @var null
     */
    protected $find;

    /**
     * ACPTTableField constructor.
     * @param MetaFieldModel $fieldModel
     * @param null $belongsTo
     * @param null $find
     */
	public function __construct(MetaFieldModel $fieldModel, $belongsTo = null, $find = null)
	{
		$this->fieldModel = $fieldModel;
        $this->belongsTo = $belongsTo;
        $this->find = $find;
    }

	/**
	 * @return string
	 */
	public function label()
	{
		return ACPTField::label($this->fieldModel);
	}

	/**
	 * @return string
	 */
	public function category()
	{
		return ACPTField::category();
	}

	/**
	 *@return string
	 */
	public function subcategory()
	{
        return ACPTField::subcategory($this->fieldModel, $this->find);
	}

	/**
	 * @return string
	 */
	public function slug()
	{
		return ACPTField::slug($this->fieldModel);
	}

	/**
	 * @inheritDoc
	 */
	public function returnTypes()
	{
		return ['string'];
	}

	/**
	 * @param mixed $attributes
	 *
	 * @return StringData
	 * @throws \Exception
	 */
	public function handler($attributes): StringData
	{
		$value = ACPTField::getValue($this->fieldModel, $attributes);

		if(is_string($value) and Strings::isJson($value)){
			$generator = new TableFieldGenerator($value);
			$value = $generator->generate();

			return StringData::fromString($value);
		}

		return StringData::emptyString();
	}
}