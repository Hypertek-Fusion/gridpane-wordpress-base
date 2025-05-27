<?php

namespace ACPT\Utils\Data;

/**
 * Class RepeaterDataAggregator
 * @package ACPT\Utils\Data
 */
class DataAggregator
{
	/**
	 * Aggregate saved nested fields
	 *
	 * @param $data
	 *
	 * @return array
	 */
	public static function aggregateNestedFieldsData($data)
	{
		if(!is_array($data)){
			return [];
		}

		$dataToRender = [];
		$keys = array_keys($data);

		if(!isset($keys[0])){
			return [];
		}

		$firstKey = $keys[0];
		$firstElement = $data[$firstKey];

		// filter only numeric indexes
        // (get rid of dirty data)
		$filteredFirstElement = array_filter(array_keys($firstElement), function($key){
            return is_numeric($key);
        });

		if(is_countable($filteredFirstElement)){
			for ($i=0; $i < count($filteredFirstElement); $i++){
				$element = [];
				foreach (array_keys($data) as $index => $key){
					$element[] = [
						'key' => $key,
						'type' => isset($data[$key][$i]['type']) ? $data[$key][$i]['type'] : null,
						'value' => isset($data[$key][$i]['value']) ? $data[$key][$i]['value'] : null,
					];
				}

				$dataToRender[] = $element;
			}
		}

		return $dataToRender;
	}
}