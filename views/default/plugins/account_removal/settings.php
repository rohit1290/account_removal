<?php

$plugin = $vars["entity"];

$noyes_options = [
	"no" => elgg_echo("option:no"),
	"yes" => elgg_echo("option:yes"),
];

$user_options = [
	"disable" => elgg_echo("account_removal:admin:settings:user_options:disable"),
	"remove" => elgg_echo("account_removal:admin:settings:user_options:remove"),
	"disable_and_remove" => elgg_echo("account_removal:admin:settings:user_options:disable_and_remove"),
];

echo elgg_view_field([
	"#type" => 'dropdown',
	"#label" => elgg_echo("account_removal:admin:settings:user_options"),
	"name" => "params[user_options]",
	"options_values" => $user_options,
	"value" => $plugin->user_options
]);

echo elgg_view_field([
	"#type" => 'dropdown',
	"#label" => elgg_echo("account_removal:admin:settings:groupadmins_allowed"),
	"name" => "params[groupadmins_allowed]",
	"options_values" => $noyes_options,
	"value" => $plugin->groupadmins_allowed
]);

echo elgg_view_field([
	"#type" => 'dropdown',
	"#label" => elgg_echo("account_removal:admin:settings:reason_required"),
	"name" => "params[reason_required]",
	"options_values" => $noyes_options,
	"value" => $plugin->reason_required
]);
?>