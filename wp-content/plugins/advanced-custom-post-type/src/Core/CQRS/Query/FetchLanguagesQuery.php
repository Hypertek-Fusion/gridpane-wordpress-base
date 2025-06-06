<?php

namespace ACPT\Core\CQRS\Query;

use ACPT\Utils\PHP\Language;
use Translation_Entry;

class FetchLanguagesQuery implements QueryInterface
{
	/**
	 * @inheritDoc
	 */
	public function execute()
	{
		$entries = [
			'languages' => [],
			'translations' => [],
		];

		$languageDir = ACPT_PLUGIN_DIR_PATH.'/i18n/languages';
		foreach (new \DirectoryIterator($languageDir) as $file){
			if($file->getExtension() === 'po'){
				$languageCode = str_replace('.po','', $file->getFilename());
				$entries['languages'][] = [
					'value' => $languageCode,
					'label' => Language::getLabel($languageCode),
				];
			}
		}

		usort($entries['languages'], function ($a, $b) {
			return strcmp($a['label'], $b['label']);
		});

		/** @var Translation_Entry $entry */
		foreach($GLOBALS['l10n'][ACPT_PLUGIN_NAME]->entries as $entry){
			$entries['translations'][$entry->key()] = $entry->translations[0];
		}

		return $entries;
	}
}