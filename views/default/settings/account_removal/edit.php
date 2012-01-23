<?php 

?>
<div>
	<?php echo elgg_echo('account_removal:admin:settings:user_options'); ?>
	<select name="params[user_options]">
		<option value="disable" <?php if ($vars['entity']->user_options == 'disable' || empty($vars['entity']->user_options)) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('account_removal:admin:settings:user_options:disable'); ?></option>
		<option value="remove" <?php if ($vars['entity']->user_options == 'remove') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('account_removal:admin:settings:user_options:remove'); ?></option>
		<option value="disable_and_remove" <?php if ($vars['entity']->user_options == 'disable_and_remove') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('account_removal:admin:settings:user_options:disable_and_remove'); ?></option>
	</select>
</div>

<div>
	<?php echo elgg_echo('account_removal:admin:settings:groupadmins_allowed'); ?>
	<select name="params[groupadmins_allowed]">
		<option value="yes" <?php if ($vars['entity']->groupadmins_allowed == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->groupadmins_allowed != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>
</div>

<div>
	<?php echo elgg_echo('account_removal:admin:settings:reason_required'); ?>
	<select name="params[reason_required]">
		<option value="yes" <?php if ($vars['entity']->reason_required == 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
		<option value="no" <?php if ($vars['entity']->reason_required != 'yes') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
	</select>
</div>
	