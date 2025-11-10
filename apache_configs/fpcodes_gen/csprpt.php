<?php
// receive csp violation report from remote browser - if they really support it.
// Start configure
$log_file = dirname(__FILE__) . '/cspviolog';
//echo $log_file;
$log_file_size_limit = 1000000; // bytes - once exceeded no further entries are added

// End configuration

$current_domain = preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']);
//$email_subject = $email_subject . ' on ' . $current_domain;

http_response_code(204); // HTTP 204 No Content

$pusherhosts=array("130.245.169.139",
"130.245.169.70",
"130.245.169.215",
"130.245.169.50",
"130.245.170.168",
"130.245.169.135",
"18.189.171.51",
"18.220.135.148",
"18.188.233.154",
"13.59.185.222");
$ip=getenv("REMOTE_ADDR");
if (in_array($ip, $pusherhosts)){
  exit();	//exit if its our pusher
}
$json_data = file_get_contents('php://input');

// We pretty print the JSON before adding it to the log file
if ($json_data = json_decode($json_data)) {
  //error_log($json_data->);
  date_default_timezone_set('America/New_York');
  $date = date('m-d-Y h:i:s', time());
  
  $json_data->cspip = $ip;
  $json_data->ts = $date;
  //$json_data[] = array('ts'=>$date,'orders_placed'=>$ip);
  //$ctent =  var_dump_ret($json_data);
  //error_log($ctent);

  $json_data = json_encode($json_data, JSON_UNESCAPED_SLASHES);

  $json_data = $json_data . "\n";

  //echo $json_data;
  file_put_contents($log_file, $json_data, FILE_APPEND | LOCK_EX);
}
function var_dump_ret($mixed = null) {
  ob_start();
  var_dump($mixed);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
