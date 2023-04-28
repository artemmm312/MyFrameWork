<?php

namespace Fw\Core\Component;

use Fw\Core\Application;
use Fw\Traits\FileExists;
use Fw\Core\InstanceContainer;

class Template
{
	use FileExists;
	
	public string $__path;
	public string $__relativePath;
	
	public function __construct(public string $id, Base $component)
	{
		$this->__path = $component->__path . '/Templates/' . $id;
		$this->__relativePath = '\Fw\Components\\' . basename(dirname($component->__path)) . '\\' . $component->id . '\Templates\\' . $id;
	}
	
	public function render(string $page = "template"): void
	{
		$result_modifier = realpath($this->__path . '/result_modifier.php');
		if (file_exists($result_modifier)) {
			include_once $result_modifier;
		}
		
		$template = $this->fileExists($this->__path . '/' . $page . '.php');
		
		$component_epilog = realpath($this->__path . '/component_epilog.php');
		if (file_exists($component_epilog)) {
			include_once $component_epilog;
		}
		
		$app = InstanceContainer::getInstance(Application::class);
		
		$jsPath = realpath($this->__path . '/js/script.js');
		if (file_exists($jsPath)) {
			$app->getPage()->addJs('<script async src="' . $this->__relativePath . '\js\script.js"></script>');
		}
		$cssPath = realpath($this->__path . '/css/style.css');
		if (file_exists($cssPath)) {
			$app->getPage()->addCss('<link href="' . $this->__relativePath . '\css\style.css" type="text/css" rel="stylesheet">');
		}
	}
}