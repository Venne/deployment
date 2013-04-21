<?php

namespace Venne\Deployment\Commands;

class ClearCacheCommand extends BaseCommand
{

	public function run()
	{
		$this->log('Clear cache');

		$config = $this->deploymentManager->getSandbox();
		$it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($config['tempDir'] . '/cache'), \RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($it as $file) {
			if (in_array($file->getBasename(), array('.', '..'))) {
				continue;
			} elseif ($file->isDir()) {
				rmdir($file->getPathname());
			} elseif ($file->isFile() || $file->isLink()) {
				unlink($file->getPathname());
			}
		}

		$this->log('Ok');
	}
}
