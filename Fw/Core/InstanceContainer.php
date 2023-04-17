<?php

namespace Fw\Core;

class InstanceContainer
{
	private static array $instances = [];
	
	private function __construct()
	{
	}
	
	public static function getInstance(string $class): ?object
	{
		if (empty(self::$instances[$class])) {
			//echo "В контейнере нет объекта такого класса \n";
			return null;
		}
		return self::$instances[$class];
	}
	
	public static function setInstance(string $class, object $object): ?object
	{
		if (!empty(self::$instances[$class])) {
			return self::getInstance($class);
		}
		if ($class === $object::class) {
			self::$instances[$class] = $object;
			return self::$instances[$class];
		}
		//echo "Объект должен соответствовать классу \n";
		return null;
	}
}