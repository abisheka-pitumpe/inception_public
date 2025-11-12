<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt files in the "core" directory.
 * honeysite info: copy this to drupal_dir/web/index.php
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

	//set all http headers we want in here

require_once '/var/www/fpcodes_gen/cachebrk.php';

require '/var/www/fpcodes_gen/globalvar.php';

	

//$domainname=get_host();

Header("Content-Security-Policy: default-src 'self' fonts.googleapis.com http://${domainname} ${domainname} www.${domainname} http://${domainname} http://www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; font-src 'self' fonts.gstatic.com data:; script-src 'self' http://${domainname} ${domainname} www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; frame-src 'none'; child-src 'self'; report-uri /fpcodes_gen/csprpt.php\n");


$autoloader = require_once 'autoload.php';

$kernel = new DrupalKernel('prod', $autoloader);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
require '/var/www/fpcodes_gen/prtfpcode.php';
$kernel->terminate($request, $response);
