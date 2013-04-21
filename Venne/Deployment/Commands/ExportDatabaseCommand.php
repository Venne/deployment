<?php

namespace Venne\Deployment\Commands;

class ExportDatabaseCommand extends DatabaseCommand
{

	public function run()
	{
		$this->log('Export database');

		system("mysqldump -u {$this->getConnection()->getUsername()} -p{$this->getConnection()->getPassword()} {$this->getConnection()->getDatabase()} > {$this->sqlFile}");

		$this->log('Ok');
	}
}
