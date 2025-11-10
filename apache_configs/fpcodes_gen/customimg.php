<?php
require_once 'cachebrk.php';
require 'globalvar.php';
//this generates js file on server side, on the fly
function echo_js(){
	global $curr_dir;
	global $curr_folder;
	header('Content-Type: text/javascript');
	//1st format
	$js_str = 'var customImg2 = new Image(1, 1);
customImg2.src = "' . $curr_dir . 'vis2.jpg?loc=scrpt&rndstr=' . cache_breaker(20) . '"
document.body.appendChild(customImg2);';
	echo $js_str;
	echo "\n";
	
	$rand_domain_name = gen_rand_subdomain(6);
	$scheme_prefix = "http://";
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		// SSL connection
		$scheme_prefix = "https://";
	}
	//2nd format
	//unable to load random sub-domain with https
	$js_str = "document.write('<img src=\""  . $curr_dir .  "vis1.jpg?loc=scrpt&rndstr=" . cache_breaker(20) . "\" width=1 height=1>');
	document.write('<img src=\"${scheme_prefix}allowthiscsp." . get_host() . $curr_folder . "visallowcsp.jpg?loc=scrpt&rndstr=" . cache_breaker(20) . "\" width=1 height=1>');
	document.write('<img src=\"${scheme_prefix}" . $rand_domain_name . $curr_folder . "visblkcsp.jpg?loc=scrpt&rndstr=" . cache_breaker(20) . "\" width=1 height=1>'); ";
	echo $js_str;
}
echo_js();
?>