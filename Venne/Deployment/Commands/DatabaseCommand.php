<?php

namespace Venne\Deployment\Commands;

use Venne\Deployment\DeploymentManager;

abstract class DatabaseCommand extends BaseCommand
{

	protected $sqlFile;

	private $_container;


	public function __construct($sqlFile = NULL)
	{
		$this->sqlFile = $sqlFile;
	}


	public function attach(DeploymentManager $deploymentManager)
	{
		parent::attach($deploymentManager);

		$this->sqlFile = $this->sqlFile ? : $this->deploymentManager->getDataDir() . '/database.sql';
	}


	public function run()
	{
	}


	protected function getContainer()
	{
		if (!$this->_container) {
			/** @var $loader Composer\Autoload\ClassLoader */
			$loader = require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/vendor/autoload.php';

			$configurator = new \Venne\Config\Configurator(dirname(dirname(dirname(dirname(__DIR__)))) . '/app', $loader);
			$configurator->enableDebugger();
			$configurator->enableLoader();
			$this->_container = $configurator->getContainer();
		}
		return $this->_container;
	}


	protected function getConnection()
	{
		return $this->getContainer()->entityManager->getConnection();
	}
}
