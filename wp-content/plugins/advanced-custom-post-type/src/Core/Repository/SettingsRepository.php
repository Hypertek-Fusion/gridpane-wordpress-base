<?php

namespace ACPT\Core\Repository;

use ACPT\Core\Models\Settings\SettingsModel;
use ACPT\Includes\ACPT_DB;

class SettingsRepository extends AbstractRepository
{
    /**
     * @param $key
     * @return SettingsModel|null
     * @throws \Exception
     */
    public static function getSingle($key)
    {
        $data = self::get($key);

        if(!empty($data) ){
            return $data[0];
        }

        return null;
    }

    /**
     * @param null $key
     *
     * @return SettingsModel[]
     * @throws \Exception
     */
    public static function get($key = null)
    {
        $results = [];
        $args = [];

        $baseQuery = "
            SELECT 
                id, 
                meta_key,
                meta_value
            FROM `".ACPT_DB::prefixedTableName(ACPT_DB::TABLE_SETTINGS)."`
            ";

        if($key){
            $baseQuery .= ' WHERE meta_key = %s';
            $args[] = $key;
        }

        $settings = ACPT_DB::getResults($baseQuery, $args);

        foreach ($settings as $setting){
            $results[] = SettingsModel::hydrateFromArray([
                    'id' => $setting->id,
                    'key' => $setting->meta_key,
                    'value' => $setting->meta_value,
            ]);
        }

        return $results;
    }
    
    /**
     * @param SettingsModel $settingsModel
     *
     * @throws \Exception
     */
    public static function save(SettingsModel $settingsModel)
    {
        $sql = "
            INSERT INTO `".ACPT_DB::prefixedTableName(ACPT_DB::TABLE_SETTINGS)."` 
            (`id`,
            `meta_key`,
            `meta_value`
            ) VALUES (
                %s,
                %s,
                %s
            ) ON DUPLICATE KEY UPDATE 
                `meta_key` = %s,
                `meta_value` = %s
        ;";

        ACPT_DB::executeQueryOrThrowException($sql, [
                $settingsModel->getId(),
                $settingsModel->getKey(),
                $settingsModel->getValue(),
                $settingsModel->getKey(),
                $settingsModel->getValue(),
        ]);
	    ACPT_DB::invalidateCacheTag(self::class);
    }
}