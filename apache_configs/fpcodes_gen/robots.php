<?php
//basic format:
//  User-agent: * 
//  Disallow: /

//

function get_dict($fndict){
	$myfile = fopen($fndict, "r") or die("Unable to open file!");
    $jsnstr = fgets($myfile);
    
    if ($json_data = json_decode($jsnstr, true)){
        //we have the json dict as array
        //usage: echo $json_data["ip1"][2];
        return $json_data;
    } 
    else{
        die("Cannot decode JSON.");
    }
	
	// $host = $_SERVER['HTTP_HOST'];
	// if(substr( $host, 0, 4 ) === "www."){
	// 	$host = substr( $host, 4);
	// }
	// return $host;
}

function checkIPvalid($ipaddr){
    //simple ip checker
    try {

        $ipparts = explode(".", $ipaddr);
        if (count($ipparts) != 4){
            //must be x.x.x.x
            //echo "invalid: ip length not right.\n";
            return false;
        }
        foreach ($ipparts as $digit){
            // each digit must be a string, and must be in range 0-255
            if(!is_numeric($digit)){
                //echo "invalid string ${digit}.\n";
                return false;
            }
            $num = (int)$digit;
            if (($num)<=255 && ($num)>=0) {
                //echo "valid.\n";
            }
            else {
                //echo "invalid digit ${num}.\n";
                return false;
            }
        }
    } catch (Exception $e) {
        //echo "Invalid address: check error\n";
        return false;
    }
    //only passed all tests you can return true
    return true;
}

function create_robotstxt($fndict, $ipaddr){
    
    $randentry = 
"Disallow: /administrator/
Disallow: /bin/
Disallow: /cache/
Disallow: /cli/
Disallow: /components/
Disallow: /includes/
Disallow: /installation/
Disallow: /language/
Disallow: /layouts/
Disallow: /libraries/
Disallow: /logs/
Disallow: /modules/
Disallow: /plugins/
Disallow: /tmp/
Disallow: /readme.html
Disallow: /refer/
Disallow: /setup/
Disallow: /php-config/
Disallow: /site-setup/
Disallow: /backup/
Disallow: /site-backups/
Disallow: /installation/
Disallow: /privatekey/";

    $randentryList = explode("\n",$randentry);
    //var_dump($randentryList);
    //return;

    $defaultaddr = "0.0.0.0";   //just in case
    $ip_word_dict = get_dict($fndict);
    //echo $ipaddr;
    $isIPValid = checkIPvalid($ipaddr);
    //var_dump($isIPValid);
    if(!$isIPValid){
        $ipaddr = $defaultaddr;
    }

    $ipparts = explode(".", $ipaddr);
    $pathstr = "";          //this is the string we add into robots.txt
    $digit1 = $ipparts[0];
    $digit2 = $ipparts[1];
    $digit3 = $ipparts[2];
    $digit4 = $ipparts[3];
    
    $word1 = $ip_word_dict["ip1"][(int)$digit1];
    $word2 = $ip_word_dict["ip2"][(int)$digit2];
    $word3 = $ip_word_dict["ip3"][(int)$digit3];
    $word4 = $ip_word_dict["ip4"][(int)$digit4];
    $wholepath = "/mypassword/${word1}/${word2}/${word3}/${word4}/password.txt";
    $robottxtStr = "User-agent: * \n";
    $lines = (int)$digit4%6 + 2;    //max 8, min 2
    $posToInsertReal = (int)$digit3%$lines;
    //var_dump($randentryList);
    for ($i = 0; $i <= $lines; $i++) {
        if($posToInsertReal == $i){
            //insert our item
            $RandRobottxtpart = $RandRobottxtpart . "Disallow: ${wholepath}\n";
        }
        else{
            $idx = ((int)$digit1 + (int)$digit2 + (int)$digit3 + (int)$digit4)%sizeof($randentryList) + $i;
            $RandRobottxtpart = $RandRobottxtpart . $randentryList[$idx] . "\n";
        }
    }
    $robottxtStr = $robottxtStr . $RandRobottxtpart;
    echo $robottxtStr;
    
}

header('Content-Type: text/plain;');
$fndict = "/var/www/fpcodes_gen/ipdict.json";
//use at test
//$fndict = "/home/lxg/projects/web-bot-project/apache_configs/fpcodes_gen/ipdict.json";
$ipaddr=getenv("REMOTE_ADDR");
//$ipaddr = "130.245.170.34";
create_robotstxt($fndict, $ipaddr);
