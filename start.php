<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function account_removal_init(){
		// extend the CSS with plugin CSS
		elgg_extend_view("css", "account_removal/css");
		
		// register pagehandler for nice URL's
		register_page_handler("account_removal", "account_removal_page_handler");
	}
	
	function account_removal_pagesetup(){
		global $CONFIG;
		
		$context = get_context();
		
		if(($context == "settings") && isloggedin() && !isadminloggedin()){
			add_submenu_item(elgg_echo('account_removal:menu:title'), $CONFIG->wwwroot . "pg/account_removal");
		}
	}
	
	function account_removal_page_handler($page){
		
		switch($page[0]){
			case "remove":
			case "disable":
				set_input("type", $page[0]);
				
				include(dirname(__FILE__) . "/pages/user.php");
				break;
			default:
				if(!empty($page[0])){
					set_input("username", $page[0]);
				}
				
				include(dirname(__FILE__) . "/pages/user.php");
				break;
		}
	}

	// register default Elgg events
	register_elgg_event_handler("init", "system", "account_removal_init");
	register_elgg_event_handler("pagesetup", "system", "account_removal_pagesetup");

	// register actions
	register_action("account_removal/remove", false, dirname(__FILE__) . "/actions/remove.php");

?>