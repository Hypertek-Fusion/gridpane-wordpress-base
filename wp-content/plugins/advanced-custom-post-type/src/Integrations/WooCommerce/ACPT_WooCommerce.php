<?php

namespace ACPT\Integrations\WooCommerce;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Integrations\AbstractIntegration;
use ACPT\Integrations\WooCommerce\Ajax\WooCommerceAjax;
use ACPT\Integrations\WooCommerce\Filters\WooCommerceFilters;
use ACPT\Integrations\WooCommerce\Generators\WooCommerceProductData;
use ACPT\Integrations\WooCommerce\Generators\WooCommerceProductVariationMetaGroups;
use ACPT\Utils\Settings\Settings;

class ACPT_WooCommerce extends AbstractIntegration
{
    /**
     * @inheritDoc
     */
    protected function isActive()
    {
        $enabledMeta = Settings::get(SettingsModel::ENABLE_META, 1) == 1;

        return $enabledMeta and is_plugin_active( 'woocommerce/woocommerce.php');
    }

    /**
     * Public facade for ACPT_WooCommerce::isActive() method
     *
     * @return bool
     */
    public static function active()
    {
        return (new ACPT_WooCommerce)->isActive();
    }

    /**
     * @inheritDoc
     */
    protected function runIntegration()
    {
        (new WooCommerceProductData())->generate();
        (new WooCommerceProductVariationMetaGroups())->generate();
        (new WooCommerceFilters())->run();
        (new WooCommerceAjax())->routes();
    }
}
