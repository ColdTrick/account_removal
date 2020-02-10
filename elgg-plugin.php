<?php
require_once __DIR__ . '/lib/functions.php';

return [
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
	],
];
