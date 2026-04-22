<?php

require_once __DIR__ . '/lib/functions.php';

return [
	'plugin' => [
		'name' => 'Account Removal',
		'version' => '7.0',
	],
	'actions' => [
		'account_removal/choices' => [],
		'account_removal/confirm' => [],
	],
	'routes' => [
		'collection:account_removal:confirm' => [
			'path' => '/account_removal/{username}/confirm/{type}',
			'resource' => 'account_removal/confirm',
		],
		'collection:account_removal:choices' => [
			'path' => '/account_removal/{username}',
			'resource' => 'account_removal/choices',
		],
		'collection:account_removal' => [
			'path' => '/account_removal',
			'resource' => 'account_removal/choices',
		],
	],
	'events' => [
		'register' => [
			'menu:page' => [
				'ColdTrick\AccountRemoval\PageMenu::settingsMenu' => [],
			],
		],
	],
	'notifications' => [
		'user' => [
			'user' => [
				'account_removal_notify' => account_removal_notify_class(),
				'account_removal_thanks' => account_removal_thanks_class(),
			],
		],
	],
];