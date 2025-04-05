<?php

$user = elgg_extract('entity', $vars);
$type = elgg_extract('type', $vars);
$token = elgg_extract('token', $vars);

if (!($user instanceof ElggUser)) {
	return;
}

// can group owners remove themselfs
if (elgg_get_plugin_setting('groupadmins_allowed', 'account_removal') !== 'yes') {
	// no, so check if the user has groups
	$group_options = [
		'type' => 'group',
		'owner_guid' => $user->getGUID(),
		'limit' => false,
		'count' => true,
	];
	if (elgg_get_entities($group_options)) {
		// user has groups, inform the user
		echo elgg_view_module('info', '', elgg_echo('account_removal:forms:user:error:group_owner'));
		echo elgg_list_entities($group_options);
		
		return;
	}
}

$reason_required = elgg_get_plugin_setting('reason_required', 'account_removal');

echo elgg_view('output/longtext', [
	'value' => elgg_echo("account_removal:forms:user:user_options:description:{$type}"),
]);

echo elgg_view_field([
	'#type' => 'longtext',
	'#label' => elgg_echo('account_removal:forms:user:reason'),
	'#help' => elgg_echo('account_removal:forms:user:reason:help'),
	'#required' => ($reason_required === 'yes'),
	'#value' => elgg_echo('account_removal:disable:default'),
	'#class' => 'account-removal-reason',
	'#placeholder' => elgg_echo('account_removal:forms:user:reason:placeholder'),
]);

$footer = elgg_view('input/hidden', [
	'name' => 'user_guid',
	'value' => $user->getGUID(),
]);
$footer .= elgg_view('input/hidden', [
	'name' => 'confirm_token',
	'value' => $token,
]);
$footer .= elgg_view('input/hidden', [
	'name' => 'type',
	'value' => $type,
]);
$footer .= elgg_view('input/submit', [
	'text' => elgg_echo('submit'),
]);

echo elgg_format_element('div', ['class' => 'elgg-foot'], $footer);
