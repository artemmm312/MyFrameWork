<?php

namespace Fw\Core;

use Exception;
final class Application
{
	private $pager = null; // будет объект класса
	private ?Application $instance = null;
	private $template = null; //будет объект класса
	
	private function __construct()
	{
	}
	public function getInstance(): Application
	{
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	private function __clone()
	{
	}
	public function __wakeup(): void
	{
		throw new Exception("Cannot unserialize a singleton.");
	}
}