<?php
/**
 * Main plugin file
 *
 */

require_once __DIR__ . '/lib/functions.php';

// register default Elgg events
elgg_register_event_handler('init', 'system', 'account_removal_init');

/**
 * Called during system init
 *
 * @return void
 */
function account_removal_init() {
	// plugin hooks
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\AccountRemoval\PageMenu::settingsMenu');
}
