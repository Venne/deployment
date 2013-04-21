<?php

namespace Venne\Deployment\Commands;

class ImportModulesCommand extends BaseCommand
{

	public function run()
	{
		$this->log('Create symlinks');

		$settings = $this->deploymentManager->getSettings();
		$sandbox = $this->deploymentManager->getSandbox();
		foreach ($settings['modules'] as $module => $items) {
			$link = $sandbox['resourcesDir'] . "/{$module}Module";
			$target = "../../vendor/venne/{$module}-module/Resources/public";
			if (!file_exists($link) && file_exists($target)) {
				symlink($target, $link);
			}
		}

		$this->log('Ok');
	}
}
