<?php

namespace ACPT\Core\CQRS\Command;

use ACPT\Core\Repository\MetaRepository;

class DeleteMetaGroupCommand implements CommandInterface
{
	/**
	 * @var string
	 */
	private $id;

	/**
	 * DeleteMetaGroupCommand constructor.
	 *
	 * @param $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed|void
	 * @throws \Exception
	 */
	public function execute()
	{
		MetaRepository::deleteMetaGroup($this->id);
		MetaRepository::removeOrphanRelationships();
	}
}