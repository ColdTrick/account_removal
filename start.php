<?php
/**
 * Main plugin file
 *
 */

require_once(dirname(__FILE__) . '/lib/functions.php');

// register default Elgg events
elgg_register_event_handler('init', 'system', 'account_removal_init');
elgg_register_event_handler('pagesetup', 'system', 'account_removal_pagesetup');

/**
 * Called during system init
 *
 * @return void
 */
function account_removal_init() {
	
	// extend the CSS with plugin CSS
	elgg_extend_view('css/elgg', 'account_removal/css');
	
	// register pagehandler for nice URL's
	elgg_register_page_handler('account_removal', '\ColdTrick\AccountRemoval\PageHandler::accountRemoval');
	
	// register actions
	elgg_register_action('account_removal/remove', dirname(__FILE__) . '/actions/remove.php');
}

/**
 * Called during page setup
 *
 * @return void
 */
function account_removal_pagesetup() {
	$user = elgg_get_logged_in_user_entity();
	if (empty($user) || $user->isAdmin()) {
		return;
	}
	
	elgg_register_menu_item('page', ElggMenuItem::factory(array(
		'name' => 'account_removal',
		'text' => elgg_echo('account_removal:menu:title'),
		'href' => 'account_removal/' . $user->username,
		'context' => 'settings'
	)));
	
}
