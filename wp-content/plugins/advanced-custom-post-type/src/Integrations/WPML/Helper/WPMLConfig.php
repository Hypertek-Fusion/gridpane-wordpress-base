<?php

namespace ACPT\Integrations\WPML\Helper;

use ACPT\Constants\MetaTypes;
use ACPT\Utils\Data\Formatter\Driver\XMLFormatter;
use ACPT\Utils\Data\Meta;

/**
 * Correct settings
 * @see https://wpml.org/documentation/related-projects/translate-sites-built-with-acf/recommended-custom-fields-translation-preferences-for-acf-and-wpml/
 */
class WPMLConfig
{
	const ACPT_WPML_CONFIG_KEY = 'acpt_wpml_config';

	/**
	 * @return string
	 */
	private static function filePath()
	{
		return ACPT_PLUGIN_DIR_PATH .'wpml-config.xml';
	}

	/**
	 * Delete the wpml-config.xml file
	 */
	public static function destroy()
	{
		Meta::delete(self::ACPT_WPML_CONFIG_KEY, MetaTypes::OPTION_PAGE, self::ACPT_WPML_CONFIG_KEY);

		if(file_exists(self::filePath())){
			unlink(self::filePath());
		}
	}

	/**
	 * @return bool
	 */
	public static function fileExists()
	{
		return file_exists(self::filePath());
	}

	/**
	 * Generate wpml-config.xml file
	 * (every 2 hours)
	 *
	 * @param array $data
	 *
	 * @return bool
	 */
	public static function generate(array $data = [])
	{
		try {
			$xml = self::xml($data);

			// save on options
			Meta::save(self::ACPT_WPML_CONFIG_KEY, MetaTypes::OPTION_PAGE, self::ACPT_WPML_CONFIG_KEY, $xml);

			// save on disk
			$fileExists = file_exists(self::filePath());

			if(!$fileExists){
				$fileExists = touch(self::filePath());
			}

			if($fileExists === true){
				if(file_put_contents(self::filePath(), $xml)){
					return true;
				}

				return false;
			}

			return false;
		} catch (\Exception $exception){
			return false;
		}
	}

	/**
	 * Generate the xml
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	public static function xml(array $data = [])
	{
		$_xml = new \SimpleXMLElement( '<wpml-config/>');

		$allowedAttributes = [
			'action',
			'style',
			'label'
		];

		// <custom-fields>
		if(isset($data['custom-fields'])){
			$fieldsNode = $_xml->addChild('custom-fields');

			foreach ($data['custom-fields'] as $fieldName => $attrs){

				// save settings for this field
				Meta::save(self::cacheFieldKey($attrs['id']), MetaTypes::OPTION_PAGE, self::cacheFieldKey($attrs['id']), $attrs);
				$fieldNode = $fieldsNode->addChild("custom-field", $fieldName);

				foreach ($attrs as $label => $value){
					if(in_array($label, $allowedAttributes)){
						$fieldNode->addAttribute($label, $value);
					}
				}
			}
		}

		// <custom-term-fields>
		if(isset($data['custom-term-fields']) and !empty($data['custom-term-fields'])){
			$fieldsNode = $_xml->addChild('custom-term-fields');

			foreach ($data['custom-term-fields'] as $fieldName => $attrs){

				// save settings for this field
				Meta::save(self::cacheFieldKey($attrs['id']), MetaTypes::OPTION_PAGE, self::cacheFieldKey($attrs['id']), $attrs);
				$fieldNode = $fieldsNode->addChild("custom-term-field", $fieldName);

				foreach ($attrs as $label => $value){
					if(in_array($label, $allowedAttributes)){
						$fieldNode->addAttribute($label, $value);
					}
				}
			}
		}

		// <admin-texts>
		if(isset($data['admin-texts']) and !empty($data['admin-texts'])){
			$fieldsNode = $_xml->addChild('admin-texts');

			foreach ($data['admin-texts'] as $fieldName => $attrs){

				// save settings for this field
				Meta::save(self::cacheFieldKey($attrs['id']), MetaTypes::OPTION_PAGE, self::cacheFieldKey($attrs['id']), $attrs);
				$fieldNode = $fieldsNode->addChild("key");
				$fieldNode->addAttribute('name', $fieldName);

				foreach ($attrs as $label => $value){
					if(in_array($label, $allowedAttributes)){
						$fieldNode->addAttribute($label, $value);
					}
				}
			}
		}

		$xml = $_xml->asXML();

		return XMLFormatter::beautify($xml);
	}

	/**
	 * @param $id
	 *
	 * @return string
	 */
	public static function cacheFieldKey($id)
	{
		return self::ACPT_WPML_CONFIG_KEY . "_field_".$id."_settings";
	}
}
