<?php
require_once 'cachebrk.php';
require 'globalvar.php';
//this generates js file on server side, on the fly
//1. if the client load vis0.jpg, it means client can run ad
//2. if the client requested ad.js but not load vis0, it means client load the js file but not running it.
//3. if the client not requesting anything, it means the client has ad-blocker.
function echo_js(){
	global $curr_dir;
	global $curr_folder;
    header('Content-Type: text/javascript');
    
	$js_str = "document.write('<img src=\""  . $curr_dir .  "vis0.jpg?loc=scrpt&type=ads&rndstr=" . cache_breaker(20) . "\" width=1 height=1>'); \n";
	echo $js_str;
}
echo_js();
?>