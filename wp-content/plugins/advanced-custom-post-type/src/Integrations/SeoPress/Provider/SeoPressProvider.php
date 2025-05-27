<?php

namespace ACPT\Integrations\SeoPress\Provider;

use ACPT\Core\Models\Meta\MetaFieldModel;
use ACPT\Utils\Wordpress\Users;
use ACPT\Utils\Wordpress\WPUtils;

/**
 * @see https://www.seopress.org/support/guides/how-to-integrate-advanced-custom-fields-acf-with-seopress/
 */
class SeoPressProvider
{
    /**
     * Allowed fields
     */
    const ALLOWED_FIELDS = [
        MetaFieldModel::ADDRESS_TYPE,
        MetaFieldModel::ADDRESS_MULTI_TYPE,
        MetaFieldModel::CHECKBOX_TYPE,
        MetaFieldModel::COLOR_TYPE,
        MetaFieldModel::COUNTRY_TYPE,
        MetaFieldModel::CURRENCY_TYPE,
        MetaFieldModel::DATE_TYPE,
        MetaFieldModel::DATE_RANGE_TYPE,
        MetaFieldModel::DATE_TIME_TYPE,
        MetaFieldModel::EDITOR_TYPE,
        MetaFieldModel::EMAIL_TYPE,
        MetaFieldModel::HTML_TYPE,
        MetaFieldModel::LENGTH_TYPE,
        MetaFieldModel::LIST_TYPE,
        MetaFieldModel::NUMBER_TYPE,
        MetaFieldModel::PASSWORD_TYPE,
        MetaFieldModel::PHONE_TYPE,
        MetaFieldModel::POST_TYPE,
        MetaFieldModel::POST_OBJECT_TYPE,
        MetaFieldModel::POST_OBJECT_MULTI_TYPE,
        MetaFieldModel::QR_CODE_TYPE,
        MetaFieldModel::RADIO_TYPE,
        MetaFieldModel::RANGE_TYPE,
        MetaFieldModel::RATING_TYPE,
        MetaFieldModel::SELECT_TYPE,
        MetaFieldModel::SELECT_MULTI_TYPE,
        MetaFieldModel::TERM_OBJECT_TYPE,
        MetaFieldModel::TERM_OBJECT_MULTI_TYPE,
        MetaFieldModel::TEXTAREA_TYPE,
        MetaFieldModel::TEXT_TYPE,
        MetaFieldModel::TIME_TYPE,
        MetaFieldModel::TOGGLE_TYPE,
        MetaFieldModel::URL_TYPE,
        MetaFieldModel::USER_TYPE,
        MetaFieldModel::USER_MULTI_TYPE,
        MetaFieldModel::WEIGHT_TYPE,
    ];

    /**
     * @var array
     */
    private array $fields = [];

    /**
     * SeoPressProvider constructor.
     */
    public function __construct()
    {
        $this->setFields();
    }

    /**
     * Register ACPT fields
     */
    private function setFields()
    {
        $groups = get_acpt_meta_group_objects();

        foreach ($groups as $group){
            foreach ($group->boxes as $box){
                foreach ($box->fields as $field){
                    if(in_array($field->type, self::ALLOWED_FIELDS)){
                        $key =  '%%_acpt_'.$box->name.'_'.$field->name.'%%';
                        $label = '[ACPT] - ' . ($box->label ?? $box->name) . " " . ($field->label ?? $field->name);

                        $this->fields[$key] = [
                            'type' => $field->type,
                            'box' => $box->label,
                            'field' => $field->name,
                            'description' => $label,
                        ];
                    }
                }
            }
        }
    }

    /**
     * Run the integration
     */
    public function run()
    {
        add_filter('seopress_titles_template_variables_array', [$this, 'spTitlesTemplateVariablesArray']);
        add_filter('seopress_titles_template_replace_array', [$this, 'spTitlesTemplateReplaceArray']);
        add_filter('seopress_get_dynamic_variables', [$this, 'spGetDynamicVariables']);
    }

    /**
     * @param array $array
     * @return array
     */
    public function spTitlesTemplateVariablesArray($array)
    {
        return array_merge($array, array_keys($this->fields));
    }

    /**
     * @param array $array
     * @return array
     */
    public function spGetDynamicVariables($array)
    {
        foreach ($this->fields as $key => $field){
            $array[$key] = $field['description'];
        }

        return $array;
    }

    /**
     * Replace the placeholder with values
     *
     * @param array $array
     * @return array
     */
    public function spTitlesTemplateReplaceArray($array)
    {
        foreach ($this->fields as $field){
            $array[] = $this->getFieldValue($field);
        }

        return $array;
    }

    /**
     * @param $field
     * @return string
     */
    private function getFieldValue($field)
    {
        global $post;

        if(empty($post)){
            return '';
        }

        $rawValue = get_acpt_field([
            'post_id' => $post->ID,
            'box_name' => $field['box'],
            'field_name' => $field['field'],
        ]);

        if(empty($rawValue)){
            return '';
        }

        switch ($field['type']){

            // ADDRESS_TYPE
            case MetaFieldModel::ADDRESS_TYPE:
                if(is_array($rawValue) and isset($rawValue['address'])){
                    $value = $rawValue['address'];
                } else {
                    $value = '';
                }
                break;

            // ADDRESS_MULTI_TYPE
            case MetaFieldModel::ADDRESS_MULTI_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){
                    $addresses = [];
                    foreach ($rawValue as $address){
                        if(is_array($address) and isset($address['address'])){
                            $addresses[] = $address['address'];
                        }
                    }

                    $value = implode(", ", $addresses);
                } else {
                    $value = "";
                }
                break;

            // RAW ARRAY VALUES
            case MetaFieldModel::CHECKBOX_TYPE:
            case MetaFieldModel::LIST_TYPE:
            case MetaFieldModel::SELECT_MULTI_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){
                    $value = implode(", ", $rawValue);
                } else {
                    $value = "";
                }
                break;

            // CURRENCY_TYPE
            case MetaFieldModel::CURRENCY_TYPE:
                if(is_array($rawValue) and isset($rawValue['currency']) and isset($rawValue['unit'])){
                    $value = $rawValue['currency'] . ' ' . $rawValue['unit'];
                } else {
                    $value ='';
                }
                break;

            // DATE_RANGE_TYPE
            case MetaFieldModel::DATE_RANGE_TYPE:
                if(is_array($rawValue) and count($rawValue) === 2){
                    $value = $rawValue[0]. " - " . $rawValue[1];
                } else {
                    $value = "";
                }
                break;

            // LENGTH_TYPE
            case MetaFieldModel::LENGTH_TYPE:
                if(is_array($rawValue) and isset($rawValue['length']) and isset($rawValue['unit'])){
                    $value = $rawValue['length'] . ' ' . $rawValue['unit'];
                } else {
                    $value ='';
                }
                break;

            case MetaFieldModel::POST_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){

                    $elements = [];

                    foreach ($rawValue as $element){
                        if($element instanceof \WP_Post){
                            $elements[] = $element->post_title;
                        } elseif($element instanceof \WP_Term){
                            $elements[] = $element->name;
                        } elseif($element instanceof \WP_User){
                            $elements[] = Users::getUserLabel($element);
                        }
                    }

                    $value = implode(", ", $elements);
                } else {
                    $value ='';
                }

                break;

            // POST_OBJECT_TYPE
            case MetaFieldModel::POST_OBJECT_TYPE:
                if($rawValue instanceof \WP_Post){
                    $value = $rawValue->post_title;
                } else {
                    $value = "";
                }
                break;

            // POST_OBJECT_MULTI_TYPE
            case MetaFieldModel::POST_OBJECT_MULTI_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){
                    $posts = [];

                    foreach ($rawValue as $post){
                        if($post instanceof \WP_Post){
                            $posts[] = $post->post_title;
                        }
                    }

                    $value = implode(", ", $posts);
                } else {
                    $value ='';
                }
                break;

            // QR_CODE_TYPE
            // URL_TYPE
            case MetaFieldModel::QR_CODE_TYPE:
            case MetaFieldModel::URL_TYPE:
                if(is_array($rawValue) and isset($rawValue['url'])){
                    $value = $rawValue['url'];
                } else {
                    $value = '';
                }
                break;

            // TERM_OBJECT_TYPE
            case MetaFieldModel::TERM_OBJECT_TYPE:
                if($rawValue instanceof \WP_Term){
                    $value = $rawValue->name;
                } else {
                    $value = "";
                }
                break;

            // TERM_OBJECT_MULTI_TYPE
            case MetaFieldModel::TERM_OBJECT_MULTI_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){
                    $terms = [];

                    foreach ($rawValue as $term){
                        if($term instanceof \WP_Term){
                            $terms[] = $term->name;
                        }
                    }

                    $value = implode(", ", $terms);

                } else {
                    $value ='';
                }
                break;

            // USER_TYPE
            case MetaFieldModel::USER_TYPE:
                if($rawValue instanceof \WP_User){
                    $value = Users::getUserLabel($rawValue);
                } else {
                    $value = "";
                }

                break;

            // USER_MULTI_TYPE
            case MetaFieldModel::USER_MULTI_TYPE:
                if(is_array($rawValue) and !empty($rawValue)){
                   $users = [];

                   foreach ($rawValue as $user){
                       if($user instanceof \WP_User){
                           $users[] = Users::getUserLabel($user);
                       }
                   }

                   $value = implode(", ", $users);

                } else {
                    $value ='';
                }
                break;

            // WEIGHT_TYPE
            case MetaFieldModel::WEIGHT_TYPE:
                if(is_array($rawValue) and isset($rawValue['weight']) and isset($rawValue['unit'])){
                    $value = $rawValue['weight'] . ' ' . $rawValue['unit'];
                } else {
                    $value ='';
                }
                break;

            // DEFAULT
            default:
                $value = $rawValue;
        }

        return esc_attr(wp_strip_all_tags($value));
    }
}
