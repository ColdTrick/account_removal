<?php 

	function acount_removal_generate_confirm_token($type, $user_guid){
		$result = false;
		
		if(!empty($user_guid) && ($user = get_user($user_guid)) && in_array($type, array("remove", "disable"))){
			$site_secret = get_site_secret();
			$user_salt = $user->salt;
			
			$result = md5($site_secret . $user_guid . $type . $user_salt);
		}
		
		return $result;
	}

	function acount_removal_validate_confirm_token($token, $type, $user_guid){
		$result = false;
		
		if(!empty($user_guid) && !empty($token) && in_array($type, array("remove", "disable"))){
			$new_token = acount_removal_generate_confirm_token($type, $user_guid);
			
			if($token == $new_token){
				$result = true;
			}
		}
		
		return $result;
	}

	function account_removal_send_notification($type, $user_guid){
		global $CONFIG;
		
		$result = false;
		
		if(!empty($user_guid) && ($user = get_user($user_guid)) && in_array($type, array("remove", "disable"))){
			$token = acount_removal_generate_confirm_token($type, $user_guid);
			$url = $CONFIG->wwwroot . "pg/account_removal/" . $type . "/?confirm_token=" . $token;
			
			$subject = sprintf(elgg_echo("account_removal:message:" . $type . ":subject"), $CONFIG->site->name);
			$message = sprintf(elgg_echo("account_removal:message:" . $type . ":body"), $user->name, $url);
			
			notify_user($user_guid, $CONFIG->site_guid, $subject, $message, null, "email");
			
			$result = true;
		}
		
		return $result;
	}
	
	function account_removal_send_thank_notification($type, $user_guid){
		global $CONFIG;
		
		$result = false;
		
		if(!empty($user_guid) && ($user = get_user($user_guid)) && in_array($type, array("remove", "disable"))){
			$subject = sprintf(elgg_echo("account_removal:message:thank_you:" . $type . ":subject"), $CONFIG->site->name);
			$message = sprintf(elgg_echo("account_removal:message:thank_you:" . $type . ":body"), $user->name, $CONFIG->site->name);
			
			notify_user($user_guid, $CONFIG->site_guid, $subject, $message, null, "email");
			
			$result = true;
		}
		
		return $result;
	}

?>