<?php

namespace ACPT\Integrations\Breakdance;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\Breakdance\Provider\BreakdanceProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_Breakdance extends AbstractIntegration
{
	/**
	 * @inheritDoc
	 */
	protected function isActive()
	{
		$isActive = is_plugin_active( 'breakdance/plugin.php' );

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
		add_action('init', function() {

			if (!function_exists('\Breakdance\DynamicData\registerField') or !class_exists('\Breakdance\DynamicData\Field')) {
				return;
			}

			BreakdanceProvider::init();
		});
	}
}
