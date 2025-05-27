<?php

namespace ACPT\Integrations\SeoPress;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\SeoPress\Provider\SeoPressProvider;
use ACPT\Utils\Settings\Settings;

class ACPT_SeoPress extends AbstractIntegration
{
    /**
     * @inheritDoc
     */
    protected function isActive()
    {
        $enabledMeta = Settings::get(SettingsModel::ENABLE_META, 1) == 1;

        if($enabledMeta and is_plugin_active('wp-seopress/seopress.php')){
            return true;
        }

        return $enabledMeta and is_plugin_active( 'wp-seopress-pro/seopress-pro.php' );
    }

    /**
     * @see https://www.seopress.org/support/guides/how-to-integrate-advanced-custom-fields-acf-with-seopress/
     */
    protected function runIntegration()
    {
        $provider = new SeoPressProvider();
        $provider->run();
    }
}
