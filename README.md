Deployment scripts for Venne framework
======================================

Installation
------------

By Git:

	git clone git://github.com/Venne/deployment.git
	rm -fr deployment/.git

By Composer:

	composer create-project venne/deployment:dev-master --prefer-dist

Optionally you can install hooks for git:

	php deployment/bin/install.php


How to use
----------

Export installation:

	php deployment/bin/export.php

Import installation:

	php deployment/bin/import.php


Deployment with Git
-------------------

Run in sandbox only first time:

	composer create-project venne/deployment:dev-master --prefer-dist
	git init
	php deployment/bin/install.php
	git add *
	git commit -m "first commit"
	git remote add origin <$server>
	git checkout -b production
	git push origin production

When you want to deploy current production branch:

	git push
