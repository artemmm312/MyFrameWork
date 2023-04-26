<?php

namespace Fw\Core\Component;

abstract class Base
{
	public array $result;
	public string $id;
	public array $params;
	public Template $template;
	public string $__path;
	
	public function __construct(string $id, array $params, string $template)
	
	{
		$this->__path = dirname((new \ReflectionClass($this))->getFileName());
		$this->id = $id;
		$this->params = $params;
		$this->template = new Template($template, $this);
	}
	
	abstract public function executeComponent();
}