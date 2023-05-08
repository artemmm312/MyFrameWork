<?php

namespace Fw\Core\Component;

use Fw\Core\Application;
use Fw\Traits\FileExists;
use Fw\Core\InstanceContainer;

class Template
{
	use FileExists;
	
	private string $__path;
	private string $__relativePath;
	private Application $app;
	private array $params;
	
	public function __construct(public string $id, Base $component)
	{
		$this->__path = $component->__path . '/Templates/' . $id;
		$this->__relativePath = '\Fw\Components\\' . basename(dirname($component->__path)) . '\\' . $component->id . '\Templates\\' . $id;
		$this->app = InstanceContainer::getInstance(Application::class);
	}
	
	public function render(array $params, string $page = "template"): void
	{
		$this->params = $params;
		
		$result_modifier = realpath($this->__path . '/result_modifier.php');
		if (file_exists($result_modifier)) {
			include_once $result_modifier;
		}
		
		$template = $this->fileExists($this->__path . '/' . $page . '.php');
		
		$component_epilog = realpath($this->__path . '/component_epilog.php');
		if (file_exists($component_epilog)) {
			include_once $component_epilog;
		}
		
		$jsPath = realpath($this->__path . '/js/script.js');
		if (file_exists($jsPath)) {
			$this->app->getPage()->addJs('<script async src="' . $this->__relativePath . '\js\script.js"></script>');
		}
		$cssPath = realpath($this->__path . '/css/style.css');
		if (file_exists($cssPath)) {
			$this->app->getPage()->addCss('<link href="' . $this->__relativePath . '\css\style.css" type="text/css" rel="stylesheet">');
		}
	}
	
	public function renderProperty(string $property = null): ?array
	{
		if (array_key_exists($property, $this->params)) {
			if ($property === 'attr') {
				foreach ($this->params[$property] as $key => $value) {
					echo $key . '="' . $value . '" ';
				}
				return null;
			}
			if (is_array($this->params[$property])) {
				return $this->params[$property];
			}
			echo $this->params[$property];
			return null;
		}
		echo '';
		return null;
	}
}