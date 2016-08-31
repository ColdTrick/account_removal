<?php

elgg_gatekeeper();

$username = elgg_extract('username', $vars);
$type = elgg_extract('type', $vars);
$token = get_input('confirm_token');

$user = false;
if (!empty($username)) {
	$user = get_user_by_username($username);
}

if (!($user instanceof ElggUser)) {
	register_error(elgg_echo('account_removal:user:error:no_user'));
	forward(REFERER);
}

if ($user->isAdmin()) {
	register_error(elgg_echo('account_removal:user:error:admin'));
	forward(REFERER);
} elseif (!$user->canEdit()) {
	register_error(elgg_echo('account_removal:user:error:user'));
	forward(REFERER);
}

// set context and page owner
elgg_push_context('settings');
elgg_set_page_owner_guid($user->getGUID());

// push breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), "settings/user/{$user->username}");
elgg_push_breadcrumb(elgg_echo('account_removal:menu:title'));

// build page elements
$title_text = elgg_echo('account_removal:user:title');

$body = elgg_view_form('account_removal/confirm', [], [
	'entity' => $user,
	'type' => $type,
	'token' => $token,
]);

// need to forward or display a page
echo elgg_view_page($title_text, elgg_view_layout('one_sidebar', [
	'title' => $title_text,
	'content' => $body,
]));

elgg_pop_context();
