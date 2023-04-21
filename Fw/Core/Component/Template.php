<?php

namespace Fw\Core\Component;

class Template
{
	public string $__path;
	public string $__relativePath;
	//public string $id;
	
	public function __construct(public string $id, Base $component)
	{
	
	}
	public function render(string $page = "template")
	{
	
	}

}