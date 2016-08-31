<?php
/**
 * Allow the user to choose what he/she wants to do with the account
 */

$user = elgg_extract('entity', $vars);
if (!($user instanceof ElggUser)) {
	return;
}

// can group owners remove themselfs
if (elgg_get_plugin_setting('groupadmins_allowed', 'account_removal') !== 'yes') {
	// no, so check if the user has groups
	$group_options = [
		'type' => 'group',
		'owner_guid' => $user->getGUID(),
		'limit' => false,
		'count' => true,
	];
	if (elgg_get_entities($group_options)) {
		// user has groups, inform the user
		echo elgg_view_module('info', '', elgg_echo('account_removal:forms:user:error:group_owner'));
		echo elgg_list_entities($group_options);
		
		return;
	}
}

elgg_require_js('account_removal/choices');

$footer = elgg_view('input/hidden', [
	'name' => 'user_guid',
	'value' => $user->getGUID(),
]);

// what choices does the user have
$user_options = elgg_get_plugin_setting('user_options', 'account_removal');
switch ($user_options) {
	case 'remove':
		$footer .= elgg_view('input/hidden', [
			'name' => 'type',
			'value' => 'remove',
		]);
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:remove'),
		]);
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:general'),
		]);
		
		break;
	case 'disable_and_remove':
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:disable_and_remove'),
		]);
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:general'),
		]);
		
		echo elgg_view_input('select', [
			'name' => 'type',
			'label' => elgg_echo('account_removal:forms:user:user_options:description:disable_and_remove:choice'),
			'options_values' => [
				'disable' => elgg_echo('account_removal:forms:user:user_options:disable'),
				'remove' => elgg_echo('account_removal:forms:user:user_options:remove'),
			],
		]);
		
		break;
	case 'disable':
	default:
		$footer .= elgg_view('input/hidden', [
			'name' => 'type',
			'value' => 'disable',
		]);
		
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:disable'),
		]);
		echo elgg_view('output/longtext', [
			'value' => elgg_echo('account_removal:forms:user:user_options:description:general'),
		]);
		
		break;
}

$footer .= elgg_view('input/submit', [
	'value' => elgg_echo('submit'),
]);

echo elgg_format_element('div', ['class' => 'elgg-foot'], $footer);
