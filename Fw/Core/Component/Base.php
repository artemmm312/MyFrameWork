<?php

namespace Fw\Core\Component;

abstract class Base
{
	public array $result;
	public string $id;
	public array $params;
	public Template $template;
	public string $__path;
	
	public function __construct()
	{
	
	}
	
	abstract public function executeComponent();
}