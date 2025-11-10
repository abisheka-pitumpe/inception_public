<?php
require_once 'cachebrk.php';
require 'globalvar.php';
?>
				
				<script type="text/javascript" src="<?php echo $curr_dir; ?>customimg.js?loc=mbdy&rndstr=<?php echo cache_breaker(20); ?>"> </script>
				<script type="text/javascript" src="<?php echo $curr_dir; ?>customajx.js?loc=mbdy&rndstr=<?php echo cache_breaker(20); ?>"> </script>

				<script type="text/javascript" src="<?php echo $curr_dir; ?>customdjs.js?loc=mbdy&rndstr=<?php echo cache_breaker(20); ?>"> </script>
				<script>
				
		var excludesAll = {userAgent: true, webdriver:true, language:true, colorDepth:true, deviceMemory:true, pixelRatio:true, hardwareConcurrency:true, screenResolution:true, availableScreenResolution:true, timezoneOffset:true, timezone:true, sessionStorage:true, localStorage:true, indexedDb:true, addBehavior:true, openDatabase:true, cpuClass:true, platform:true, doNotTrack:true, plugins:true, canvas:true, webgl:true, webglVendorAndRenderer:true, adBlock:true, hasLiedLanguages:true, hasLiedResolution:true, hasLiedOs:true, hasLiedBrowser:true, touchSupport:true, fonts:true, fontsFlash:true, audio:true, enumerateDevices:true };
		var defOptions = {
			preprocessor: null,
			audio: {
			timeout: 1000,
			// On iOS 11, audio context can only be used in response to user interaction.
			// We require users to explicitly enable audio fingerprinting on iOS 11.
			// See https://stackoverflow.com/questions/46363048/onaudioprocess-not-called-on-ios11#46534088
			excludeIOS11: true
			},
			fonts: {
			swfContainerId: 'fingerprintjs2',
			swfPath: 'flash/compiled/FontList.swf',
			userDefinedFonts: [],
			extendedJsFonts: false
			},
			screen: {
			// To ensure consistent fingerprints when users rotate their mobile devices
			detectScreenOrientation: true
			},
			plugins: {
			sortPluginsFor: [/palemoon/i],
			excludeIE: false
			},
			extraComponents: [],
			excludes: {
			// Unreliable on Windows, see https://github.com/Valve/fingerprintjs2/issues/375
			'enumerateDevices': true,
			// devicePixelRatio depends on browser zoom, and it's impossible to detect browser zoom
			'pixelRatio': true,
			// DNT depends on incognito mode for some browsers (Chrome) and it's impossible to detect incognito mode
			'doNotTrack': true,
			// uses js fonts already
			'fontsFlash': true
			},
			NOT_AVAILABLE: 'not available',
			ERROR: 'error',
			EXCLUDED: 'excluded'
		};

		var brkid = "<?php echo cache_breaker(20); ?>";
		brkkv = {key:"brk", value:brkid};
		var fprslt = [];
		

		//load fpjs2 without delay
		for ( var k in excludesAll) {
			opt1 = JSON.parse(JSON.stringify(defOptions));
			opt1['excludes']=JSON.parse(JSON.stringify(excludesAll))
			opt1['excludes'][k]=false;
			try {
				Fingerprint2.get(opt1, function(components){ 
				if (components.length >0){
					fprslt.push(components[0]);}
				else{
					fprslt.push({key:k, value:"--nothing--"});
					console.log(k + "--nothing--");
				}
				});
			}
			catch(error) {
			//console.error(error);
			// Note - error messages will vary depending on browser
			}
			
		}
		//compute hash
		var values = fprslt.map(function (component) { return component.value })
		var murmur = Fingerprint2.x64hash128(values.join(''), 31)		//second param is seed
		fphashkv = {key:"fphashkv", value:murmur}
		fprslt.push(fphashkv);
		fprslt.push(brkkv);
		
		jQuery.ajax({
		type: 'POST',
		url: '<?php echo $curr_dir; ?>main.php?loc=mnodelay&rndstr=' + brkid,
		data: JSON.stringify(fprslt),
		contentType: "application/json",
		cache: false,
		success: function(response) {
			//console.log(response);
			console.log(fprslt);
		},
		error: function(response){
			console.log("Error");
					}
		})
		
		//load them with slight delay
					if (window.requestIdleCallback) {
						requestIdleCallback(function () {
							var brkid = "<?php echo cache_breaker(20); ?>";
							brkkv = {key:"brk", value:brkid};
							var fprslt = [];
							
							for ( var k in excludesAll) {
								opt1 = JSON.parse(JSON.stringify(defOptions));
								opt1['excludes']=JSON.parse(JSON.stringify(excludesAll))
								opt1['excludes'][k]=false;
								try {
									Fingerprint2.get(opt1, function(components){ 
									if (components.length >0){
										fprslt.push(components[0]);}
									else{
										fprslt.push({key:k, value:"--nothing--"});
										console.log(k + "--nothing--");
									}
									});
								}
								catch(error) {
								//console.error(error);
								// Note - error messages will vary depending on browser
								}
								
							}
							//compute hash
							var values = fprslt.map(function (component) { return component.value })
							var murmur = Fingerprint2.x64hash128(values.join(''), 31)		//second param is seed
							fphashkv = {key:"fphashkv", value:murmur}
							fprslt.push(fphashkv)
							fprslt.push(brkkv)
							//do the post
							jQuery.ajax({
							type: 'POST',
							url: '<?php echo $curr_dir; ?>main.php?loc=midcb&rndstr=' + brkid,
							data: JSON.stringify(fprslt),
							contentType: "application/json",
							cache: false,
							success: function(response) {
								//console.log(response);
								console.log(fprslt);
							},
							error: function(response){
								console.log("Error");
										}
					})
						})
					} else {
						setTimeout(function () {
								var brkid = "<?php echo cache_breaker(20); ?>";
								brkkv = {key:"brk", value:brkid};
								var fprslt = [];
								
								for ( var k in excludesAll){
								opt1 = JSON.parse(JSON.stringify(defOptions));
								opt1['excludes']=JSON.parse(JSON.stringify(excludesAll))
								opt1['excludes'][k]=false;
								try {
									Fingerprint2.get(opt1, function(components){ 
									if (components.length >0){
										fprslt.push(components[0]);}
									else{
										fprslt.push({key:k, value:"--nothing--"});
										console.log(k + "--nothing--");
									}
									});
								}
								catch(error) {
								//console.error(error);
								// Note - error messages will vary depending on browser
								}
							}
							//compute hash
							var values = fprslt.map(function (component) { return component.value })
							var murmur = Fingerprint2.x64hash128(values.join(''), 31)		//second param is seed
							fphashkv = {key:"fphashkv", value:murmur}
							fprslt.push(fphashkv)
							fprslt.push(brkkv)
							//do the post
							jQuery.ajax({
							type: 'POST',
							url: '<?php echo $curr_dir; ?>main.php?loc=mtmout&rndstr=' + brkid,
							data: JSON.stringify(fprslt),
							contentType: "application/json",
							cache: false,
							success: function(response) {
								//console.log(response);
								console.log(fprslt);
							},
							error: function(response){
								console.log("Error");
										}
					})
						}, 500)
					}

		</script>
		<script type="text/javascript" src="<?php echo $curr_dir_http . "customhtp.js?loc=mbdy&rndstr=" . cache_breaker(20); ?>"> </script>
		<img src="<?php echo $curr_dir_http . "vishtp.jpg?loc=mbdy&rndstr=" . cache_breaker(20); ?>" width=1 height=1>
		<script type="text/javascript" src="<?php echo $curr_dir . "ads.js?loc=mbdy&rndstr=" . cache_breaker(20); ?>"> </script>
		<script type="text/javascript" src="<?php echo $curr_dir . "ad.js?loc=mbdy&rndstr=" . cache_breaker(20); ?>"> </script>
		<img src="<?php echo $scheme_prefix . "allowthiscsp." . get_host() . $curr_folder . "visallowcsp.jpg?loc=mbdy&rndstr=" . cache_breaker(20); ?>" width=1 height=1>
		<img src="<?php echo $scheme_prefix . gen_rand_subdomain(6) . $curr_folder . "visblkcsp.jpg?loc=mbdy&rndstr=" . cache_breaker(20); ?>" width=1 height=1>

		<script type="text/javascript" src="<?php echo $scheme_prefix . "allowthiscsp." . get_host() . $curr_folder . "visallowcspjs.js?loc=mbdy&rndstr=" . cache_breaker(20); ?>"> </script>
		<script type="text/javascript" src="<?php echo $scheme_prefix . gen_rand_subdomain(6) . $curr_folder . "visblkcspjs.js?loc=mbdy&rndstr=" . cache_breaker(20); ?>"> </script>

		<link rel="stylesheet" href="<?php echo $scheme_prefix . "allowthiscsp." . get_host() . $curr_folder . "visallowcspcss.css?loc=mbdy&rndstr=" . cache_breaker(20); ?>">
		<link rel="stylesheet" href="<?php echo $scheme_prefix . gen_rand_subdomain(6) . $curr_folder . "visblkcspcss.css?loc=mbdy&rndstr=" . cache_breaker(20); ?>">
		<style>
			iframe {display: none;}
		</style>
		<iframe id="custominlineIframe"
		title="custom Frame page"
		width="1"
		height="1"
		src="<?php echo $curr_dir; ?>customhtm.html?rndstr=<?php echo cache_breaker(20); ?>">
		</iframe>
		