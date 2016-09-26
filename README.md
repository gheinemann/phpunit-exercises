# phpunit-exercises

This project has for purpose to hands-on PHPUnit testing framework and to testing development.

The **master** branch hold nothing, every exercise is in its own branch.

## Getting started
	- clone the project and go into the folder "phpunit-exercises"
	- run "git fetch origin" to update your local repository
	- checkout exercise branch by running "git checkout refactoring/mapper"
	- in root folder, download composer.phar
	- in the command line, run "php composer.phar install"
	- in the command line, run "vendor/bin/phpunit" to launch the test suite

## Goal
	- we would like to cover our class Mapper with tests
	- we will progress by following these steps :
		1. Refactor so that every single data mapping is testable and create tests
		2. Adjust test to new specialty mapping needs (src/new_specialty_mapping.php)
		3. Refactor so that special behaviors are testable and create tests (data enhancing + formatting)
		4. Test the mapData function
		5. test the mapDataToDB function

## Dependencies
	- PHP v5.5 or v5.4 (http://php.net/downloads.php)
	- Git (https://git-scm.com/downloads)
	- composer.phar in root directory (https://getcomposer.org/download/ section "Manual Download")
	- PHPUnit (via Composer)

## Resources
	- Composer doc : https://getcomposer.org/doc/
	- PHPUnit doc : https://phpunit.de/manual/current/en/index.html