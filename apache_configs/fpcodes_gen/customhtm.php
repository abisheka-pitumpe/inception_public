<?php
require_once 'cachebrk.php';
require 'globalvar.php';
//this generates js file on server side, on the fly
function echo_htm(){
        global $curr_dir;
        $js_str = '<html>
        <header><title>Custom iframe title</title></header>
        <head> <link rel="stylesheet" href=" ' . $curr_dir . 'ex.css?loc=chtm&rndstr=' . cache_breaker(20) . '"> </head>
        <body>
        customized html, with 1 image.
        <img src="'  . $curr_dir .  'vis1.jpg?loc=chtm&rndstr=' . cache_breaker(20) . '" width=1 height=1>
        </body>
        </html>';
        echo $js_str;
        echo "\n";
}
echo_htm();
?>


