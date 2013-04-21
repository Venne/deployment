<?php

namespace Venne\Deployment\Commands;

use Venne\Deployment\ICommand;
use Venne\Deployment\DeploymentManager;

abstract class BaseCommand implements ICommand
{

	protected $deploymentManager;


	public function __construct()
	{
	}


	public function attach(DeploymentManager $deploymentManager)
	{
		$this->deploymentManager = $deploymentManager;
	}


	public function run()
	{
	}


	public function log($message)
	{
		$this->deploymentManager->log($message);
	}
}
