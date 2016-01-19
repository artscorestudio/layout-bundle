<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
$file = __DIR__ . '/../vendor/autoload.php';

if ( !file_exists($file) ) {
	$file = __DIR__ . '/../../../../vendor/autoload.php';
	if ( !file_exists($file) ) {
		throw new \Exception('Run composer install command in your bundle to run test suite.');
	}
}

$loader = require_once $file;

require_once __DIR__ . '/Fixtures/app/AppKernel.php';