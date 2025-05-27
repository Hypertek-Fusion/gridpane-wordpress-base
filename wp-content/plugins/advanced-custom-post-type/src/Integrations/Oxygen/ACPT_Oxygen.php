<?php

namespace ACPT\Integrations\Oxygen;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\Oxygen\Provider\OxygenDataProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_Oxygen extends AbstractIntegration
{
	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = is_plugin_active( 'oxygen/functions.php' );

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
		add_filter( 'oxygen_custom_dynamic_data', [new OxygenDataProvider(), 'initDynamicData'], 10, 1 );
	}
}
