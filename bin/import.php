<?php

$rootDir = dirname(dirname(__DIR__));
$appDir = $rootDir . '/app';
include_once dirname(__DIR__) . '/Venne/Deployment/Loader.php';

// update dependencies
if (!file_exists($rootDir . '/composer.phar')) {
	$url = 'https://getcomposer.org/composer.phar';
	file_put_contents($rootDir . '/composer.phar', file_get_contents($url));
}
if ($_SERVER['argv'][1]) {
	require $rootDir . '/composer.phar';
	exit;
}
system('cd ' . $rootDir . ' && php composer.phar install --prefer-dist -v');

// deployment
$dm = new Venne\Deployment\DeploymentManager($appDir);
$dm->addCommand(new Venne\Deployment\Commands\ClearCacheCommand);
$dm->addCommand(new Venne\Deployment\Commands\ImportDatabaseCommand);
$dm->addCommand(new Venne\Deployment\Commands\ImportModulesCommand);
$dm->run();
