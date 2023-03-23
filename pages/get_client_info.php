<?php
	function GetMAC(){
	    ob_start();
	    system('getmac');
	    $Content = ob_get_contents();
	    ob_clean();
	    $mac = substr($Content, strpos($Content,'\\')-20, 17);
	    return $mac;
		 
	}

	function get_ip_address() {
		// check for shared internet/ISP IP
		if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// check for IPs passing through proxies
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// check if multiple ips exist in var
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
				$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				foreach ($iplist as $ip) {
					if (validate_ip($ip))
						return $ip;
				}
			} else {
				if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
					return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
			return $_SERVER['HTTP_X_FORWARDED'];
		if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
			return $_SERVER['HTTP_FORWARDED_FOR'];
		if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
			return $_SERVER['HTTP_FORWARDED'];
		// return unreliable ip since all else failed
		return $_SERVER['REMOTE_ADDR'];
	}
?>

<?php
 /****************************************************
  * Modified Date: 1/31/2018 
  ****************************************************/
?>