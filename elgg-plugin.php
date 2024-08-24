<?php
use ColdTrick\AccountRemoval\Bootstrap;

require_once __DIR__ . '/lib/functions.php';

return [
	'plugin' => [
		'version' => '6.0',
	],
	'bootstrap' => Bootstrap::class,
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
];
