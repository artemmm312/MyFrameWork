<?php

namespace Fw\Core;

class InstanceContainer
{
	private static array $instances = [];
	
	private function __construct()
	{
	}
	
	public static function getInstance(string $class, object $object = null): ?object
	{
		if (empty(self::$instances[$class])) {
			if ($object === null) {
				return null;
			}
			if (empty(self::setInstance($class, $object))) {
				return null;
			}
		}
		return self::$instances[$class];
	}
	
	private static function setInstance(string $class, object $object): ?object
	{
		if ($class === $object::class) {
			return self::$instances[$class] = $object;
		}
		return null;
	}
}