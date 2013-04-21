<?php

$rootDir = dirname(dirname(__DIR__));
$appDir = $rootDir . '/app';
include_once dirname(__DIR__) . '/Venne/Deployment/Loader.php';

// deployment
$dm = new Venne\Deployment\DeploymentManager($appDir);
$dm->addCommand(new Venne\Deployment\Commands\ExportDatabaseCommand);
$dm->run();
