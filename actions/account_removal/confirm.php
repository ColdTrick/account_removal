<?php

$user_guid = (int) get_input('user_guid');
$type = get_input('type');
$reason = get_input('reason');
$confirm_token = get_input('confirm_token');

$user = get_user($user_guid);
if (!($user instanceof ElggUser) || !$user->canEdit()) {
	register_error(elgg_echo('actionunauthorized'));
	forward(REFERER);
}

if ($user->isAdmin()) {
	register_error(elgg_echo('account_removal:actions:remove:error:user_guid:admin'));
	forward(REFERER);
}

if (!in_array($type, ['remove', 'disable'])) {
	register_error(elgg_echo('account_removal:actions:remove:error:type_match'));
	forward(REFERER);
}

// check if group owner
$group_admins_allowed = elgg_get_plugin_setting('groupadmins_allowed', 'account_removal');

$group_options = [
	'type' => 'group',
	'owner_guid' => $user->getGUID(),
	'count' => true,
];
if ($group_admins_allowed !== 'yes' && elgg_get_entities($group_options)) {
	register_error(elgg_echo('account_removal:actions:remove:error:group_owner'));
	forward(REFERER);
}

// reason required
$reason_required = elgg_get_plugin_setting('reason_required', 'account_removal');
if (($reason_required === 'yes') && empty(strip_tags($reason))) {
	register_error(elgg_echo('account_removal:actions:remove:error:reason'));
	forward(REFERER);
}

// validate token
if (!acount_removal_validate_confirm_token($confirm_token, $type, $user_guid)) {
	register_error(elgg_echo('account_removal:actions:remove:error:token_mismatch'));
	forward(REFERER);
}

// prepend the reason with users own request
$reason = elgg_echo('account_removal:disable:default') . '. ' . $reason;

// send a thank you e-mail
account_removal_send_thank_notification($type, $user_guid);

// user has supplied a token, so we can do the action
if ($type == 'disable') {
	$user->ban($reason, false);
	logout();
} elseif ($type == 'remove') {
	$user->delete(false);
}

system_message(elgg_echo("account_removal:actions:remove:success:{$type}"));

$forward_url = '';
