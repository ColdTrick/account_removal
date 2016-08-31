<?php
/**
 * All helper functions are bundled here
 */

/**
 * Get the hmac token generator for account removal
 *
 * @param string $type what kind of token
 * @param int    $user_guid the user_guid to generate for
 *
 * @access private
 *
 * @return false|\Elgg\Security\Hmac
 */
function account_removal_get_hmac($type, $user_guid) {
	
	$user = get_user($user_guid);
	if (empty($user)) {
		return false;
	}
	
	if (!in_array($type, ['remove', 'disable'])) {
		return false;
	}
	
	return elgg_build_hmac([
		$user->getGUID(),
		$type,
		$user->salt,
	]);
}

/**
 * Generate a validation token
 *
 * @param string $type      what kind of token
 * @param int    $user_guid the user_guid to generate for
 *
 * @return bool|string
 */
function acount_removal_generate_confirm_token($type, $user_guid) {
	
	$hmac = account_removal_get_hmac($type, $user_guid);
	if (empty($hmac)) {
		return false;
	}
	
	return $hmac->getToken();
}

/**
 * Validate a token for account removal
 *
 * @param string $token     the token to validate
 * @param string $type      what kind of token
 * @param int    $user_guid the user_guid to validate for
 *
 * @return bool
 */
function acount_removal_validate_confirm_token($token, $type, $user_guid) {
	
	$hmac = account_removal_get_hmac($type, $user_guid);
	if (empty($hmac)) {
		return false;
	}
	
	return $hmac->matchesToken($token);
}

/**
 * Send a notification to the user for confirmation of account removal
 *
 * @param string $type      what kind of removal
 * @param int    $user_guid the user_guid to send the notification to
 *
 * @return bool
 */
function account_removal_send_notification($type, $user_guid) {
	
	$site = elgg_get_site_entity();
	
	$user = get_user($user_guid);
	if (empty($user)) {
		return false;
	}
	
	if (!in_array($type, ['remove', 'disable'])) {
		return false;
	}
	
	$token = acount_removal_generate_confirm_token($type, $user_guid);
	if (empty($token)) {
		return false;
	}
	
	$url = elgg_normalize_url("account_removal/{$user->username}/confirm/{$type}/?confirm_token={$token}");
	
	$subject = elgg_echo("account_removal:message:{$type}:subject", [
		$site->name,
	]);
	$message = elgg_echo("account_removal:message:{$type}:body", [
		$user->name,
		$url,
	]);
	
	notify_user($user_guid, $site->getGUID(), $subject, $message, null, 'email');
	
	return true;
}

/**
 * Send a thank you notification after account removal
 *
 * @param string $type      what kind of removal
 * @param int    $user_guid the user_guid to send the notification to
 *
 * @return bool
 */
function account_removal_send_thank_notification($type, $user_guid) {
	
	$user = get_user($user_guid);
	if (empty($user)) {
		return false;
	}
	
	if (!in_array($type, ['remove', 'disable'])) {
		return false;
	}
	
	$site = elgg_get_site_entity();
	
	$subject = elgg_echo("account_removal:message:thank_you:{$type}:subject", [
		$site->name,
	]);
	$message = elgg_echo("account_removal:message:thank_you:{$type}:body", [
		$user->name,
		$site->name,
	]);
	
	notify_user($user_guid, $site->getGUID(), $subject, $message, null, 'email');
	
	return true;
}
