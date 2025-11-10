 <?php

try {
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
		http_response_code(204); // HTTP 204 No Content
		if($_SERVER['REQUEST_METHOD'] !== 'POST'){
			//not a POST request
			//error_log("Not a POST request: " . $_SERVER['REQUEST_METHOD']);
			exit();
		}
		$ip=getenv("REMOTE_ADDR");
		if (in_array($ip, $pusherhosts)){
			exit();	//exit if its our pusher
		}
		$log_file = dirname(__FILE__) . '/fpjs2log';
		$json_data = file_get_contents('php://input');
		$pos = strpos($json_data, '&_nocache=');
		if ($pos != false){
			$json_data = substr($json_data, 0, $pos);
		}
		if ($json_data = json_decode($json_data)) {
		foreach($json_data as $key => $obj) {
				$fingerprints[$obj->key] = json_encode($obj->value);
		}
			$ip=getenv("REMOTE_ADDR");
			date_default_timezone_set('America/New_York');
			$date = date('m-d-Y h:i:s', time());
			$fingerprints["fpjsip"] = $ip;
			$fingerprints["fpjsts"] = $date;
		}
		$json_data = json_encode($fingerprints, JSON_UNESCAPED_SLASHES);
		$json_data = $json_data . "\n";
		file_put_contents($log_file, $json_data, FILE_APPEND | LOCK_EX);
		// $data = json_decode(file_get_contents('php://input'));

		// $fingerprints = array();

		// foreach($data as $key => $obj) {
		// 		$fingerprints[$obj->key] = json_encode($obj->value);
		// }

		// // Insert into database

		// $conn = new mysqli('localhost', 'wordpress_usr', 'b0td3t3ct!15', 'ICBots');
		// // Check connection
		// if ($conn->connect_error) {
		//     die("Connection failed: " . $conn->connect_error);
		// }


		// $stmt = $conn->prepare("INSERT INTO `jsfingerprints` (`cookie_id`, `datetime`, `ip`, `user_agent`, `language`, `color_depth`, `device_memory`, `hardware_concurrency`, `screen_resolution`, `available_screen_resolution`, `timezone_offset`, `timezone`, `session_storage`, `local_storage`, `indexed_db`, `add_behavior`, `open_database`, `cpu_class`, `platform`, `plugins`, `canvas`, `webgl`, `webgl_vendor`, `adblock`, `haslied_language`, `haslied_resolution`, `haslied_os`, `haslied_browser`, `touch_support`, `fonts`, `audio`) VALUES (?, CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		// $stmt->bind_param("sssssssssssiiiiissssssiiiiiiss", $cookie_id, $ip, $user_agent, $language, $color_depth, $device_memory, $hardware_concurrency, $screen_resolution, $available_screen_resolution, $timezone_offset, $timezone, $session_storage, $local_storage, $indexed_db, $ad_behavior, $open_database, $cpu_class, $platform, $plugins, $canvas, $webgl, $webgl_vendor, $adblock, $haslied_language, $haslied_resolution, $haslied_os, $haslied_browser, $touch_support, $fonts, $audio);

		// // set parameters and execute
		
		// if(isset($_COOKIE['SESSION_ID'])) {
		// 		$cookie_id = $_COOKIE['SESSION_ID'];
		// }
		// else {
		// 		$cookie_id = '';
		// }
		// $ip = $_SERVER['REMOTE_ADDR'];
		// $user_agent  = $fingerprints['userAgent'];
		// $language = $fingerprints['language'];
		// $color_depth = $fingerprints['colorDepth'];
		// $device_memory = $fingerprints['deviceMemory'];
		// $hardware_concurrency = $fingerprints['hardwareConcurrency'];
		// $screen_resolution = $fingerprints['screenResolution'];
		// $available_screen_resolution = $fingerprints['availableScreenResolution'];
		// $timezone_offset = $fingerprints['timezoneOffset'];
		// $timezone = $fingerprints['timezone'];
		// $session_storage = $fingerprints['sessionStorage'];
		// $local_storage = $fingerprints['localStorage'];
		// $indexed_db = $fingerprints['indexedDb'];
		// $ad_behavior = $fingerprints['addBehavior'];
		// $open_database = $fingerprints['openDatabase'];
		// $cpu_class = $fingerprints['cpuClass'];
		// $platform = $fingerprints['platform'];
		// $plugins = $fingerprints['plugins'];
		// $canvas = $fingerprints['canvas'];
		// $webgl = $fingerprints['webgl'];
		// $webgl_vendor = $fingerprints['webglVendorAndRenderer'];
		// $adblock = $fingerprints['adBlock'];
		// $haslied_language = $fingerprints['hasLiedLanguages'];
		// $haslied_resolution = $fingerprints['hasLiedResolution'];
		// $haslied_os = $fingerprints['hasLiedOs'];
		// $haslied_browser = $fingerprints['hasLiedBrowser'];
		// $touch_support = $fingerprints['touchSupport'];
		// $fonts = $fingerprints['fonts'];
		// $audio  = $fingerprints['audio'];
		// $stmt->execute();

		// echo '1';

		// $stmt->close();
		// $conn->close();
}
catch(Exception $e) {
		echo '0';
}
