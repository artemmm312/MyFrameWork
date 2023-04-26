<?php

use Fw\Core\InstanceContainer;
use Fw\Core\Application;

$DIR = substr_replace(__DIR__, '', -2);
set_include_path(get_include_path() . PATH_SEPARATOR . $DIR);
spl_autoload_register(static function (string $class): void {
	if (preg_match('/\\\\/', $class)) {
		$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
	}
	if (\stream_resolve_include_path("{$class}.php")) {
		require_once("{$class}.php");
	}
});

session_start();

define('CORE', 'CORE');

$app = InstanceContainer::getInstance(Application::class, [InstanceContainer::getInstance()]);
