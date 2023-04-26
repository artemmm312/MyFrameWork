<?php

namespace Fw\Core;

class InstanceContainer
{
	private static array $instances = [];
	private static InstanceContainer $instance;
	
	private function __construct()
	{
	}
	
	public static function getInstance(string $class = null, array $args = null): ?object
	{
		if(empty($class)) {
			if (empty(self::$instance)){
				self::$instance = new self();
			}
			return self::$instance;
		}
		if (empty(self::$instances[$class])) {
			self::setInstance($class, $args);
		}
		return self::$instances[$class];
	}
	
	private static function setInstance(string $class, array $args = null): void
	{
		try {
			$cls = new \ReflectionClass($class);
		} catch (\ReflectionException $e) {
			throw new \ReflectionException("Класс не существует");
		}
		$constructor = $cls->getConstructor();
		$parameters = $constructor->getParameters();
		if (count($parameters) === 0) {
			self::$instances[$class] = new $class();
			return;
		}
		if (count($parameters) !== count($args)) {
			throw new \RuntimeException("Количество параметров не совпадает");
		}
		self::$instances[$class] = new $class(...$args);
	}
}