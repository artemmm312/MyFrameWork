<?php

namespace Fw\Core;

class Config
{
	private static array $config;
	
	public static function get(string $path): mixed
	{
		$file = \stream_resolve_include_path('Fw/config.php');
		if (empty($file)) {
			throw new \RuntimeException("Config file(Fw/config.php) not found");
		}
		static::$config = require($file);
		$parts = explode("/", $path);
		$value = static::$config;
		
		foreach ($parts as $part) {
			if (isset($value[$part])) {
				$value = $value[$part];
			} else {
				throw new \RuntimeException("Config parameter not found");
			}
		}
		return $value;
	}
}
