<?php

spl_autoload_register(static function (string $class): void {
	if (preg_match('/\\\\/', $class)) {
		$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
	}
	if (\stream_resolve_include_path("{$class}.php")) {
		require_once("{$class}.php");
	}
});

session_start();
