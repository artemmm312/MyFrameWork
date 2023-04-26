<?php

namespace Fw\Core;

use Fw\Core\Type\Request;
use Fw\Core\Type\Server;
use Fw\Core\Type\Session;

final class Application
{
	private ?Page $pager = null;
	private $template = null; //будет объект класса
	
	public function __construct($context)
	{
		InstanceContainer::getInstance(Request::class);
		InstanceContainer::getInstance(Server::class);
		InstanceContainer::getInstance(Session::class);
		if(!($context instanceof InstanceContainer)) {
			throw new \RuntimeException('Контекст не соответствует InstanceContainer.');
		}
	}
	
	public function getPage(): Page
	{
		if (empty($this->pager)) {
			$this->pager = new Page();
		}
		return $this->pager;
	}
	
	private function startBuffer(): void
	{
		ob_start();
	}
	
	private function endBuffer(): void
	{
		$content = ob_get_contents();
		$content = $this->getPage()->getAllReplace($content);
		ob_end_clean();
		echo $content;
	}
	
	public function restartBuffer(): void
	{
		ob_clean();
	}
	
	public function header(): void
	{
		$this->startBuffer();
		$template = Config::get('templates/main') . 'header.php';
		if (!file_exists($template)) {
			throw new \RuntimeException("Файл '{$template}' не существует");
		}
		include $template;
	}
	
	public function footer(): void
	{
		$template = Config::get('templates/main') . 'footer.php';
		if (!file_exists($template)) {
			throw new \RuntimeException("Файл '{$template}' не существует");
		}
		include $template;
		$this->endBuffer();
	}
	
	public function getRequest(): Request
	{
		return InstanceContainer::getInstance(Request::class);
	}
	
	public function getServer(): Server
	{
		return InstanceContainer::getInstance(Server::class);
	}
	
	public function getSession(): Session
	{
		return InstanceContainer::getInstance(Session::class);
	}
	
	public function includeComponent(string $component, string $template, array $params)
	{
		[$namespace, $id] = explode(":", $component);
		$file = __DIR__ . '/../Components/' . $namespace . '/' . $id . '/.class.php';
		$component_file = realpath($file);
		include_once $component_file;
		$component_class = '';
		foreach (get_declared_classes() as $class) {
			$ref = new \ReflectionClass($class);
			if ($ref->getFileName() === $component_file) {
				$component_class = $class;
				break;
			}
		}
		$component_object = new $component_class($id, $params, $template);
		$component_object->executeComponent();
	}
}