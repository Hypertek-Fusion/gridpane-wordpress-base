<?php

namespace ACPT\Core\CQRS\Query;

use ACPT\Admin\ACPT_License_Manager;
use ACPT\Utils\Http\ACPTApiClient;

class FetchLicenseQuery implements QueryInterface
{
	/**
	 * @return array|mixed|void
	 * @throws \Exception
	 */
	public function execute()
	{
		$currentVersion = ACPT_PLUGIN_VERSION;
		$licenseActivation = ACPT_License_Manager::getLicense();
		$activation = ACPTApiClient::call('/license/activation/fetch', [
			'id' => $licenseActivation['activation_id'],
		]);

		if(isset($activation['error'])){
		    throw new \Exception($activation['error']);
        }

		unset($licenseActivation['license']);

		$versionInfo = [
			'currentVersion' => $currentVersion,
			'licenseActivation' => $licenseActivation,
		];

		return array_merge($activation, $versionInfo);
	}
}