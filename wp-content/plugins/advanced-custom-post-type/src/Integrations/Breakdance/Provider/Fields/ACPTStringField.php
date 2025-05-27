<?php

namespace ACPT\Integrations\Breakdance\Provider\Fields;

use ACPT\Core\Models\Meta\MetaFieldModel;
use Breakdance\DynamicData\StringData;
use Breakdance\DynamicData\StringField;

class ACPTStringField extends StringField implements ACPTFieldInterface
{
    /**
     * @var MetaFieldModel
     */
    protected MetaFieldModel $fieldModel;
    /**
     * @var null
     */
    private $belongsTo;
    /**
     * @var null
     */
    private $find;

    /**
     * ACPTStringField constructor.
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
     * @return string
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

        if (!is_string($value) or $value === null) {
            return StringData::emptyString();
        }

        return StringData::fromString($value);
    }
}