<?php

namespace ACPT\Integrations\WPAllImport;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\WPAllImport\Addon\WPAIAddon;
use ACPT\Utils\Settings\Settings;

class ACPT_WPAllImport extends AbstractIntegration
{

	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = is_plugin_active( 'wp-all-import-pro/wp-all-import-pro.php' ) or is_plugin_active( 'wp-all-import/wp-all-import.php' );

		if(!$isActive){
			return false;
		}

		$enabledMeta = Settings::get(SettingsModel::ENABLE_META, 1) == 1;

		return $enabledMeta and $isActive;
	}

	/**
	 * @inheritDoc
	 */
	protected function runIntegration()
	{
		WPAIAddon::getInstance();
	}
}