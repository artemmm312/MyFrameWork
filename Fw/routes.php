<?php

$routes =
	[
		[
			'condition' => '#^/news/([0-9]+)/([0-9]+)/#',
			//регулярное выражение, по которому мы будем парсить url
			'rule' => 'sid=$1&id=$2',
			//это переменные - результаты группировок регулярного выражения,
			//для подставновки в request
			'path' => "/news/index.php",
			//путь к файлу обработчику такого типа урлов
		],
		[
		
		],
	];
