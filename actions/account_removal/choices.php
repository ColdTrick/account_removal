<?php

$user_guid = (int) get_input('user_guid');
$type = get_input('type');

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

// user requests removal, generate token and sent confirm mail
account_removal_send_notification($type, $user_guid);

system_message(elgg_echo('account_removal:actions:remove:success:request'));

forward("settings/user/{$user->username}");
