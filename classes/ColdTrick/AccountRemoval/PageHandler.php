<?php

namespace ColdTrick\AccountRemoval;

class PageHandler {
	
	/**
	 * handler /account_removal
	 *
	 * @param array $page the url segments
	 *
	 * @return true
	 */
	public static function accountRemoval($page) {
		
		switch (elgg_extract(0, $page)) {
			case 'remove':
			case 'disable':
				$vars['type'] = $page[0];
				
				echo elgg_view_resource('account_removal/user', $vars);
				break;
			default:
				$vars['username'] = elgg_extract(0, $page);
				
				echo elgg_view_resource('account_removal/user', $vars);
				break;
		}
		
		return true;
	}
}
