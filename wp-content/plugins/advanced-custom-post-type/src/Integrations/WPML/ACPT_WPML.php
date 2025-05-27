<?php

namespace ACPT\Integrations\WPML;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\Polylang\Helper\PolylangChecker;
use ACPT\Integrations\WPML\Helper\WPMLChecker;
use ACPT\Integrations\WPML\Helper\WPMLConfig;
use ACPT\Integrations\WPML\Provider\MetaFieldsProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_WPML extends AbstractIntegration
{
	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = WPMLChecker::isActive();

		if(!$isActive){
			return false;
		}

		$enabledMeta = Settings::get(SettingsModel::ENABLE_META, 1) == 1;

		if($enabledMeta != 1){
			$isActive = false;
		}

		if(!$isActive and !PolylangChecker::isActive()){
			WPMLConfig::destroy();
		}

		return $isActive;
	}

	/**
	 * @inheritDoc
	 */
	protected function runIntegration()
	{
		add_action( 'plugins_loaded', [new ACPT_WPML(), 'generateConfigFile']);
	}

	/**
	 * Genereate WPML settings
	 */
	public function generateConfigFile()
	{
		$fields = MetaFieldsProvider::getInstance()->getFields();
		WPMLConfig::generate($fields);
	}
}
