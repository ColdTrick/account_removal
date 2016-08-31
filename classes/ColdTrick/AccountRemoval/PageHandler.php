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
		
		$vars = [
			'username' => elgg_extract(0, $page),
		];
		
		$action = elgg_extract(1, $page);
		
		switch ($action) {
			case 'confirm':
				$vars['type'] = elgg_extract(2, $page);
				
				echo elgg_view_resource('account_removal/confirm', $vars);
				break;
			default:
				echo elgg_view_resource('account_removal/choices', $vars);
				break;
		}
		
		return true;
	}
}
