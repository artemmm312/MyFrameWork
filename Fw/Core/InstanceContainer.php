<?php

namespace Fw\Core;

class InstanceContainer
{
	private static array $instances = [];
	
	private function __construct()
	{
	}
	
	public static function getInstance(string $class, array $args = null): ?object
	{
		if (empty(self::$instances[$class])) {
			self::setInstance($class, $args);
		}
		return self::$instances[$class];
	}
	
	private static function setInstance(string $class, array $args = null): ?object
	{
		try {
			$cls = new \ReflectionClass($class);
		} catch (\ReflectionException $e) {
			throw new \ReflectionException("Класс не существует");
		}
		$constructor = $cls->getConstructor();
		$parameters = $constructor->getParameters();
		if (count($parameters) === 0) {
			return self::$instances[$class] = new $class();
		}
		if (count($parameters) !== count($args)) {
			throw new \RuntimeException("Количество параметров не совпадает");
		}
		return self::$instances[$class] = new $class(...$args);
	}
}