<?php

$user_guid = (int) get_input('user_guid');
$type = get_input('type');

$user = get_user($user_guid);
if (!($user instanceof ElggUser) || !$user->canEdit()) {
	elgg_register_error_message(elgg_echo('actionunauthorized'));
	forward(REFERRER);
}

if ($user->isAdmin()) {
	elgg_register_error_message(elgg_echo('account_removal:actions:remove:error:user_guid:admin'));
	forward(REFERRER);
}

if (!in_array($type, ['remove', 'disable'])) {
	elgg_register_error_message(elgg_echo('account_removal:actions:remove:error:type_match'));
	forward(REFERRER);
}

// check if group owner
$group_admins_allowed = elgg_get_plugin_setting('groupadmins_allowed', 'account_removal');

$group_options = [
	'type' => 'group',
	'owner_guid' => $user->getGUID(),
	'count' => true,
];
if ($group_admins_allowed !== 'yes' && elgg_get_entities($group_options)) {
	elgg_register_error_message(elgg_echo('account_removal:actions:remove:error:group_owner'));
	forward(REFERRER);
}

// user requests removal, generate token and sent confirm mail
account_removal_send_notification($type, $user_guid);

elgg_register_success_message(elgg_echo('account_removal:actions:remove:success:request'));

forward("settings/user/{$user->username}");
