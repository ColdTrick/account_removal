<?php 

	gatekeeper();
	
	$username = get_input("username");
	$type = get_input("type");
	
	$forward = true;
	
	if(!empty($username)){
		$user = get_user_by_username($username);
	} else {
		$user = get_loggedin_user();
	}
	
	if(!empty($user)){
		if($user->isAdmin() && ($user->getGUID() == get_loggedin_userid())){
			register_error(elgg_echo("account_removal:user:error:admin"));
		} elseif(!$user->isAdmin() && ($user->getGUID() != get_loggedin_userid()) && !isadminloggedin()) {
			register_error(elgg_echo("account_removal:user:error:user"));
		} else {
			$forward = false;
			
			set_context("settings");
			set_page_owner($user->getGUID());
			
			// build page elements
			$title_text = elgg_echo("account_removal:user:title");
			$title = elgg_view_title($title_text);
			
			$body = elgg_view("account_removal/forms/user", array("entity" => $user, "type" => $type));
			
			// build page
			$page_data = $title . $body;
		}
	} else {
		register_error(elgg_echo("account_removal:user:error:no_user"));
	}

	// need to forward or display a page
	if($forward){
		forward(REFERER);
	} else {
		page_draw($title_text, elgg_view_layout("two_column_left_sidebar", "", $page_data));
	}

?>