<?php

return [
	'handler' => 'Api\AuthController',
	'route' => [
		['login', 'POST', 'login'],
		['register', 'POST', 'registered'],
		['test', 'GET', 'index']
	]
];