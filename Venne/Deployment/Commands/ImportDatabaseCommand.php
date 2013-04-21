<?php

namespace Venne\Deployment\Commands;

class ImportDatabaseCommand extends DatabaseCommand
{

	public function run()
	{
		$this->log('Create database');

		$sql = 'SET FOREIGN_KEY_CHECKS=0;' . file_get_contents($this->sqlFile) . '; SET FOREIGN_KEY_CHECKS=1;';
		$this->getConnection()->exec($sql);

		$this->log('Ok');
	}
}
