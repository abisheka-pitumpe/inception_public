<?php
$myfile = fopen("/domainname", "r") or die("Unable to open file!");
$httpd_host = fgets($myfile);
$httpd_host = str_replace(array("\n", "\r"), '', $httpd_host);
//echo $httpd_host;
fclose($myfile);
//$httpd_host = $_SERVER['HTTP_HOST'];
//$parse = parse_url($httpd_host);
//$httpd_host = $parse['host'];
//echo $httpd_host;
$curr_folder = "/pmac/"; //for pma
$curr_dir = "https://" . $httpd_host . "/pmac/";	//for pma
function enc_data($data) { 
	return openssl_encrypt($data, "AES-128-CBC", "icbots_enc", $options=0, $iv="icbots1234567890");
}
function dec_data($data) { 
	return openssl_decrypt($data, "AES-128-CBC", "icbots_enc", $options=0, $iv="icbots1234567890");
}

// from https://www.php.net/manual/en/function.base64-encode.php
function base64url_encode($data) { 
	return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
}

function base64url_decode($data) { 
	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
}
function gen_rand_str($length){
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";//
	$rndstr="";
	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ){
		$rndchar = $chars[rand(0, $size-1)];  
		$rndstr = $rndstr . $rndchar;
	}
	return $rndstr;
}
function cache_breaker($length){
	//generate random string with specified len
	#echo "ip:" + $ip;
	
	#echo "enc: " + $encodestr;
	$ip=getenv("REMOTE_ADDR");
	#$decodestr = base64url_decode($encodestr);
	#echo "dec: " + $decodestr;

	$rndstr = gen_rand_str($length);
	$rndstr = $rndstr . $ip;	// when decode, trim out first X chars to get encoded string
	$encryptStr = enc_data($rndstr);
	$encodestr = base64url_encode($encryptStr);
	return $encodestr;
}
function gen_rand_subdomain($length){
	$s = gen_rand_str($length) . '.' .  get_host();
	return $s;
}
function get_host(){
	global $httpd_host;
	return $httpd_host;
	// $host = $_SERVER['HTTP_HOST'];
	// if(substr( $host, 0, 4 ) === "www."){
	// 	$host = substr( $host, 4);
	// }
	// return $host;
	
}
//echo cache_breaker(20);