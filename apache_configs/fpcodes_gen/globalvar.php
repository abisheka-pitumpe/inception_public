<?php
require_once 'cachebrk.php';

$httpd_host = get_host();
$scheme_prefix = "http://";
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
	// SSL connection
	$scheme_prefix = "https://";
}
$curr_folder = "/fpcodes_gen/";
$curr_dir = $scheme_prefix . $httpd_host . "/fpcodes_gen/";
$curr_dir_http = "http://" . $httpd_host . "/fpcodes_gen/";
$domainname = $httpd_host;