<?php

namespace ACPT\Core\JSON;

use ACPT\Constants\BelongsTo;
use ACPT\Constants\Logic;
use ACPT\Constants\Operator;

class BelongSchema extends AbstractJSONSchema
{
	/**
	 * @inheritDoc
	 */
	function toArray()
	{
		return [
			'type' => 'object',
			'additionalProperties' => false,
			'properties' => [
				'id' => [
					'type' => 'string',
					'format' => 'uuid',
					'readOnly' => true,
				],
				'belongsTo' => [
					'type' => 'string',
					'example' => 'POST_ID',
					'enum' => BelongsTo::ALLOWED_FORMATS
				],
				'operator' => [
					'type' => ['string', 'null'],
					'example' => '=',
					'nullable' => true,
					'enum' => Operator::ALLOWED_VALUES
				],
				'find' => [
					'type' => ['string', 'null'],
					'example' => '12',
					'nullable' => true,
				],
				'logic' => [
					'type' =>['string', 'null'],
					'example' => 'AND',
					'enum' => Logic::ALLOWED_VALUES
				],
				"sort" => [
					'type' => 'integer',
					'example' => 1,
					'readOnly' => true,
				],
			],
			'required' => [
				'belongsTo',
			]
		];
	}
}