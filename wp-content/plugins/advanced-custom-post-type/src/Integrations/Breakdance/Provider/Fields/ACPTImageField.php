<?php

namespace ACPT\Integrations\Breakdance\Provider\Fields;

use ACPT\Core\Models\Meta\MetaFieldModel;
use Breakdance\DynamicData\ImageData;
use Breakdance\DynamicData\ImageField;

class ACPTImageField extends ImageField implements ACPTFieldInterface
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
     * ACPTImageField constructor.
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
	 * @return ImageData
	 * @throws \Exception
	 */
	public function handler($attributes): ImageData
	{
		$value = ACPTField::getValue($this->fieldModel, $attributes);

		if(empty($value)){
			return ImageData::emptyImage();
		}

		return ImageData::fromAttachmentId($value);
	}
}