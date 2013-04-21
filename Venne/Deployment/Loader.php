<?php

function __autoload($class)
{
	if (strpos($class, 'Venne\\Deployment\\') === FALSE) {
		return;
	}

	$file = __DIR__ . '/' . substr($class, 17) . '.php';
	include str_replace('\\', '/', $file);
}
