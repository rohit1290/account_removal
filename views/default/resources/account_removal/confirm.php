<?php

elgg_gatekeeper();

$username = elgg_extract('username', $vars);
if($username == null) {
	$username = elgg_get_logged_in_user_entity()->username;
}
$type = elgg_extract('type', $vars);
$token = get_input('confirm_token');

$user = false;
if (!empty($username)) {
	$user = elgg_get_user_by_username($username);
}

if (!($user instanceof ElggUser)) {
	elgg_register_error_message(elgg_echo('account_removal:user:error:no_user'));
	elgg_redirect_response(REFERRER);
}

if ($user->isAdmin()) {
	elgg_register_error_message(elgg_echo('account_removal:user:error:admin'));
	elgg_redirect_response(REFERRER);
} elseif (!$user->canEdit()) {
	elgg_register_error_message(elgg_echo('account_removal:user:error:user'));
	elgg_redirect_response(REFERRER);
}

// set context and page owner
elgg_push_context('settings');
elgg_set_page_owner_guid($user->getGUID());

// push breadcrumb
elgg_push_breadcrumb(elgg_echo('settings'), "settings/user/{$user->username}");
elgg_push_breadcrumb(elgg_echo('account_removal:menu:title'));

// build page elements
$title_text = elgg_echo('account_removal:user:title');

$body = elgg_view_form('account_removal/confirm', [], [
	'entity' => $user,
	'type' => $type,
	'token' => $token,
]);

// need to forward or display a page
echo elgg_view_page($title_text, elgg_view_layout('one_sidebar', [
	'title' => $title_text,
	'content' => $body,
]));

elgg_pop_context();
