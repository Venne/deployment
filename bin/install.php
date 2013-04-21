<?php

$gitDir = getcwd() . '/.git';

if (!file_exists($gitDir)) {
	echo "Git repository does not exist in $gitDir\n\n";
	exit;
}

echo "Install hooks\n";
if (file_exists($gitDir)) {
	umask(0000);
	copy(dirname(__DIR__) . '/hooks/pre-commit', "$gitDir/hooks/pre-commit");
	chmod("$gitDir/hooks/pre-commit", 0755);
	echo "Ok\n\n";
} else {
	echo "Git repository doest not exist\n\n";
}

echo "Create hook file for Venne hosting\n";
file_put_contents(dirname(dirname(__DIR__)) . '/.deploy.php', "<?php include __DIR__ . '/deployment/bin/import.php';");
echo "Ok\n\n";
