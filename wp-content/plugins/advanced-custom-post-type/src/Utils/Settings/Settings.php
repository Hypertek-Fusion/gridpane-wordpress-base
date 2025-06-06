<?php

namespace ACPT\Utils\Settings;

use ACPT\Core\Repository\SettingsRepository;

class Settings
{
	/**
	 * @param $key
	 * @param null $defaultValue
	 *
	 * @return string|null
	 */
	public static function get($key, $defaultValue = null)
	{
		try {
			$fetched = SettingsRepository::getSingle($key);

			return ($fetched !== null and !empty($fetched)) ? $fetched->getValue() : $defaultValue;
		} catch (\Exception $exception){
			return $defaultValue;
		}
	}
}