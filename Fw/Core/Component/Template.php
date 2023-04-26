<?php

namespace Fw\Core\Component;

class Template
{
	public string $__path;
	public string $__relativePath;
	
	public function __construct(public string $id, Base $component)
	{
		$this->__path = $component->__path . '/Templates/' . $id;
		$this->__relativePath = '/Templates/' . $id;
	}
	public function render(string $page = "template"): void
	{
		$template = realpath($this->__path . '/' . $page . '.php');
		if (!file_exists($template)) {
			throw new \RuntimeException("Файл '{$template}' не существует");
		}
		include_once $template;
	}
}