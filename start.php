<?php
/**
 * Main plugin file
 *
 */

require_once(dirname(__FILE__) . '/lib/functions.php');

// register default Elgg events
elgg_register_event_handler('init', 'system', 'account_removal_init');

/**
 * Called during system init
 *
 * @return void
 */
function account_removal_init() {
	
	// register pagehandler for nice URL's
	elgg_register_page_handler('account_removal', '\ColdTrick\AccountRemoval\PageHandler::accountRemoval');
	
	// plugin hooks
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\AccountRemoval\PageMenu::settingsMenu');
	
	// register actions
	elgg_register_action('account_removal/choices', dirname(__FILE__) . '/actions/choices.php');
	elgg_register_action('account_removal/confirm', dirname(__FILE__) . '/actions/confirm.php');
}
