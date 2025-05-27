<?php

namespace ACPT\Integrations\Zion;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\Zion\Provider\ZionProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_Zion extends AbstractIntegration
{
	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = is_plugin_active('zionbuilder-pro/zionbuilder-pro.php') or is_plugin_active('zionbuilder/zionbuilder.php');

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
		$provider = new ZionProvider();
		$provider->init();
	}
}