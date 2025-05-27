<?php

namespace ACPT\Integrations\Breakdance\Provider\Fields;

use ACPT\Core\Models\Meta\MetaFieldModel;
use Breakdance\DynamicData\GalleryData;
use Breakdance\DynamicData\GalleryField;
use Breakdance\DynamicData\ImageData;

class ACPTGalleryField extends GalleryField implements ACPTFieldInterface
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
     * ACPTGalleryField constructor.
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
	 * @return GalleryData
	 * @throws \Exception
	 */
	public function handler($attributes): GalleryData
	{
		$attachmentIds = ACPTField::getValue($this->fieldModel, $attributes);
		$gallery = new GalleryData();

		if(empty($attachmentIds)){
			return $gallery;
		}

		$images = [];

		foreach ($attachmentIds as $attachmentId){
			$images[] = ImageData::fromAttachmentId($attachmentId);
		}

		$gallery->images = $images;

		return $gallery;
	}
}