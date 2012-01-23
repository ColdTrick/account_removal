<?php 

	gatekeeper();
	
	$username = get_input("username");
	$type = get_input("type");
	
	$forward = true;
	
	if(!empty($username)){
		$user = get_user_by_username($username);
	} else {
		$user = elgg_get_logged_in_user_entity();
	}
	
	if(!empty($user)){
		if($user->isAdmin() && ($user->getGUID() == elgg_get_logged_in_user_guid())){
			register_error(elgg_echo("account_removal:user:error:admin"));
		} elseif(!$user->isAdmin() && ($user->getGUID() != elgg_get_logged_in_user_guid()) && !elgg_is_admin_logged_in()) {
			register_error(elgg_echo("account_removal:user:error:user"));
		} else {
			$forward = false;
			
			// set context and page owner
			elgg_set_context("settings");
			elgg_set_page_owner_guid($user->getGUID());
			
			// push breadcrumb
			elgg_push_breadcrumb(elgg_echo("settings"), "settings/user/" . $user->username);
			elgg_push_breadcrumb(elgg_echo("account_removal:menu:title"));
			
			// build page elements
			$title_text = elgg_echo("account_removal:user:title");
			
			$body = elgg_view("account_removal/forms/user", array("entity" => $user, "type" => $type));
		}
	} else {
		register_error(elgg_echo("account_removal:user:error:no_user"));
	}

	// need to forward or display a page
	if($forward){
		forward(REFERER);
	} else {
		echo elgg_view_page($title_text, elgg_view_layout("one_sidebar", array(
			"title" => $title_text,
			"content" => $body
		)));
	}
