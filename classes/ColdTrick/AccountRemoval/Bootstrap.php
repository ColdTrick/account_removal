<?php

namespace ColdTrick\AccountRemoval;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {

	/**
	 * {@inheritDoc}
	 */
	public function init() {
    elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\AccountRemoval\PageMenu::settingsMenu');
	}
}