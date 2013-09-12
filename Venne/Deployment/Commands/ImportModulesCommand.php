<?php

namespace Venne\Deployment\Commands;

class ImportModulesCommand extends BaseCommand
{

	public function run()
	{
		$this->log('Create symlinks');

		$settings = $this->deploymentManager->getSettings();
		$sandbox = $this->deploymentManager->getSandbox();

		include_once $sandbox['libsDir'] . '/autoload.php';

		foreach ($settings['modules'] as $module => $items) {
			$modulePath = strtr($items['path'], array(
				'%libsDir%' => $sandbox['libsDir'],
				'%modulesDir%' => $sandbox['modulesDir'],
			));

			include_once $modulePath . '/Module.php';
			$instance = new $items['class'];

			$link = $sandbox['resourcesDir'] . "/{$module}Module";
			$target = $modulePath . '/' . $instance->getRelativePublicPath();
			if (!file_exists($link) && file_exists($target)) {
				symlink($target, $link);
			}
		}

		$this->log('Ok');
	}
}
