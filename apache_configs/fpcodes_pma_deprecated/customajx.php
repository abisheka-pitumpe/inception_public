<?php
require_once 'cachebrk.php';
//this generates js file on server side, on the fly
function echo_js(){
        global $curr_dir;
        header('Content-Type: text/javascript');
        $js_str = 'var url_str ="' . $curr_dir . 'customjsn.json?loc=scrpt&rndstr1=' . cache_breaker(20) . '"
        $.ajax({
                url: url_str,
                dataType: "json",
                success: function(data){
                        console.log("success");
                        console.log(data);
                }
        })';
        echo $js_str;
        echo "\n";
}
echo_js();
?>