<?php 

	$user = $vars["entity"];
	$type = $vars["type"];
	
	if($user instanceof ElggUser){
		$group_admins_allowed = get_plugin_setting("groupadmins_allowed", "account_removal");
		$user_options = get_plugin_setting("user_options", "account_removal");
		$reason_required = get_plugin_setting("reason_required", "account_removal");
		
		$group_options = array(
			"type" => "group",
			"owner_guid" => $user->getGUID(),
			"limit" => false,
			"full_view" => false,
			"site_guids" => false
		);
		
		if(($group_admins_allowed != "yes") && ($group_list = elgg_list_entities($group_options))){
			$form = elgg_view("page_elements/contentwrapper", array("body" => elgg_echo("account_removal:forms:user:error:group_owner")));
			$form .= $group_list;
		} else {
			
			$form_data .= elgg_view("input/hidden", array("internalname" => "user_guid", "value" => $user->getGUID()));
			
			if(empty($type)){
				switch($user_options){
					case "remove":
						$js_confirm = elgg_echo("account_removal:forms:user:js:confirm:remove");
						
						$form_data .= elgg_view("input/hidden", array("internalname" => "type", "value" => "remove"));
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:remove") . "</div>";
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:general") . "</div>";
						
						break;
					case "disable_and_remove":
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:disable_and_remove") . "</div>";
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:general") . "</div>";
						$form_data .= "<br />";
						
						$options_values = array(
							"disable" => elgg_echo("account_removal:forms:user:user_options:disable"),
							"remove" => elgg_echo("account_removal:forms:user:user_options:remove")
						);
						
						$form_data .= elgg_view("input/pulldown", array("internalname" => "type", "options_values" => $options_values));
						
						break;
					case "disable":
					default:
						$js_confirm = elgg_echo("account_removal:forms:user:js:confirm:disable");
						
						$form_data .= elgg_view("input/hidden", array("internalname" => "type", "value" => "disable"));
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:disable") . "</div>";
						$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:general") . "</div>";
						break;
				}
				
				$form_data .= elgg_view("input/hidden", array("internalname" => "reason", "value" => "not_yet"));
			
			} else {
				$js_confirm = elgg_echo("account_removal:forms:user:js:confirm:" . $type);
				
				$form_data .= elgg_view("input/hidden", array("internalname" => "confirm_token", "value" => get_input("confirm_token")));
				$form_data .= elgg_view("input/hidden", array("internalname" => "type", "value" => $type));
				$form_data .= "<div>" . elgg_echo("account_removal:forms:user:user_options:description:" . $type) . "</div>";
				
				$form_data .= "<br />";
				$form_data .= "<div class='account_removal_form_label'>";
				$form_data .= elgg_echo("account_removal:forms:user:reason");
				if($reason_required == "yes"){
					$form_data .= "*";
				}
				$form_data .= "</div>";
				$form_data .= elgg_view("input/longtext", array("internalname" => "reason"));
			}
			
			$form_data .= "<div>";
			$form_data .= elgg_view("input/submit", array("value" => elgg_echo("submit")));
			$form_data .= "</div>";
			
			if($reason_required == "yes"){
				$form_data .= "<div id='account_removal_forms_required'>*: " . elgg_echo("account_removal:forms:user:required") . "</div>";
			}
			
			$form = elgg_view("input/form", array("body" => $form_data,
													"action" => $vars["url"] . "action/account_removal/remove",
													"internalid" => "account_removal_user_form"));
			
			$form = elgg_view("page_elements/contentwrapper", array("body" => $form));
		}
	} else {
		$form = elgg_view("page_elements/contentwrapper", array("body" => elgg_echo("account_removal:forms:user:error:no_user")));
	}

	echo $form; 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#account_removal_user_form').submit(function(){
			var result = false;
			var error_count = 0;
			var error_msg = "";

			<?php if(!empty($type) && ($reason_required == "yes")) { ?>
			if($(this).find('textarea[name="reason"]').val() == ""){
				error_count++;
				error_msg += "<?php echo elgg_echo("account_removal:forms:user:js:error:reason"); ?>\n";
			}
			<?php } ?>

			if(error_count > 0){
				alert(error_msg);
			} else {
				<?php if(empty($type) && ($user_options == "disable_and_remove")){ ?>
				
				if($(this).find('select[name="user_options"] option:selected').val() == "remove"){
					var confirm_msg = "<?php echo elgg_echo("account_removal:forms:user:js:confirm:remove"); ?>";
				} else {
					var confirm_msg = "<?php echo elgg_echo("account_removal:forms:user:js:confirm:disable"); ?>";
				}
				<?php } else { ?>
				var confirm_msg = "<?php echo $js_confirm; ?>";
				<?php } ?>
				
				if(confirm(confirm_msg)){
					result = true;
				}
			}
			
			return result;
		});
	});
</script>
