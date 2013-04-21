<?php

namespace Venne\Deployment;

class DeploymentManager
{

	protected $appDir;

	protected $queue = array();

	protected $sandbox;

	protected $settings;

	protected $dataDir;


	public function __construct($appDir, $dataDir = NULL)
	{
		$this->sandbox = require $appDir . '/sandbox.php';
		$this->settings = require $this->sandbox['configDir'] . '/settings.php';
		$this->dataDir = $dataDir ? : dirname(dirname(__DIR__)) . '/data';
		$_SERVER['SERVER_NAME'] = gethostname();
	}


	public function run()
	{
		foreach ($this->queue as $callback) {
			$callback->run();
		}
	}


	public function addCommand(ICommand $callback)
	{
		$this->queue[] = $callback;
		$callback->attach($this);
	}


	public function log($message)
	{
		echo "$message\n";
	}


	public function getSandbox()
	{
		return $this->sandbox;
	}


	public function getSettings()
	{
		return $this->settings;
	}


	public function getAppDir()
	{
		return $this->appDir;
	}


	public function getDataDir()
	{
		return $this->dataDir;
	}
}
