<?php

namespace ACPT\Integrations\WPGridBuilder;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\WPGridBuilder\Provider\WPGridBuilderDataProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_WPGridBuilder extends AbstractIntegration
{
	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = is_plugin_active( 'wp-grid-builder/wp-grid-builder.php' );

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
		new WPGridBuilderDataProvider();
	}
}
