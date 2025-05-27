<?php

namespace ACPT\Integrations\Breakdance\Provider\Fields;

use ACPT\Core\Models\Meta\MetaFieldModel;
use Breakdance\DynamicData\OembedData;
use Breakdance\DynamicData\OembedField;

class ACPTOembedField extends OembedField implements ACPTFieldInterface
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
     * ACPTOembedField constructor.
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
	 * @param mixed $attributes
	 *
	 * @return OembedData
	 * @throws \Exception
	 */
	public function handler($attributes): OembedData
	{
		$resource = ACPTField::getValue($this->fieldModel, $attributes);

		if(!is_string($resource) or $resource === null){
			return new OembedData();
		}

		return OembedData::fromOembedUrl($resource);
	}
}