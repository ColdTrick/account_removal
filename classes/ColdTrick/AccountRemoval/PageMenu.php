<?php

namespace ColdTrick\AccountRemoval;

class PageMenu {
	
	public static function settingsMenu($hook, $type, $return_value, $params) {
		
		if (!elgg_is_logged_in() || !elgg_in_context('settings')) {
			return;
		}
		
		$user = elgg_get_page_owner_entity();
		if (!($user instanceof \ElggUser)) {
			return;
		}
		
		if ($user->isAdmin()) {
			// admins can't remove themselfs
			return;
		}
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'account_removal',
			'text' => elgg_echo('account_removal:menu:title'),
			'href' => "account_removal/{$user->username}",
		]);
		
		return $return_value;
	}
}
