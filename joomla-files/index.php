<?php
/**
 * @package    Joomla.Site
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Define the application's minimum supported PHP version as a constant so it can be referenced within the application.
 */
define('JOOMLA_MINIMUM_PHP', '5.3.10');

if (version_compare(PHP_VERSION, JOOMLA_MINIMUM_PHP, '<'))
{
	die('Your host needs to use PHP ' . JOOMLA_MINIMUM_PHP . ' or higher to run this version of Joomla!');
}

// Saves the start time and memory usage.
$startTime = microtime(1);
$startMem  = memory_get_usage();

/**
 * Constant that is checked in included files to prevent direct access.
 * define() is used in the installation folder rather than "const" to not error for PHP 5.2 and lower
 */
define('_JEXEC', 1);

if (file_exists(__DIR__ . '/defines.php'))
{
	include_once __DIR__ . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', __DIR__);
	require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_BASE . '/includes/framework.php';

//set header here
require_once '/var/www/fpcodes_gen/cachebrk.php';
require '/var/www/fpcodes_gen/globalvar.php';
Header("Content-Security-Policy: default-src 'self' fonts.googleapis.com http://${domainname} ${domainname} www.${domainname} http://${domainname} http://www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; font-src 'self' fonts.gstatic.com data:; script-src 'self' http://${domainname} ${domainname} www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; frame-src 'none'; child-src 'self'; report-uri /fpcodes_gen/csprpt.php\n");

// Set profiler start time and memory usage and mark afterLoad in the profiler.
JDEBUG ? JProfiler::getInstance('Application')->setStart($startTime, $startMem)->mark('afterLoad') : null;

// Instantiate the application.
$app = JFactory::getApplication('site');

// Execute the application.
$app->execute();
//fp codes
require '/var/www/fpcodes_gen/prtfpcode.php';
