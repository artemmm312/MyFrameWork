<?php

namespace Fw\Core;

use Fw\Core\Type\Request;
use Fw\Core\Type\Server;
use Fw\Core\Type\Session;
use Fw\Traits\FileExists;

final class Application
{
	use FileExists;
	
	private ?Page $pager = null;
	private $template = null; //будет объект класса
	private array $components = [];
	
	public function __construct($context)
	{
		InstanceContainer::getInstance(Request::class);
		InstanceContainer::getInstance(Server::class);
		InstanceContainer::getInstance(Session::class);
		if (!($context instanceof InstanceContainer)) {
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
		$template = Config::get('templates/default') . 'header.php';
		$this->fileExists($template);
	}
	
	public function footer(): void
	{
		$template = Config::get('templates/default') . 'footer.php';
		//include_once $template;
		$this->fileExists($template);
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
	
	public function includeComponent(string $component, string $template, array $params): void
	{
		[$namespace, $id] = explode(":", $component);
		if (array_key_exists($component, $this->components)) {
			$componentObject = new $this->components[$component]($id, $template, $params);
			$componentObject->executeComponent();
			return;
		}
		$declaredClassesOne = get_declared_classes();
		//$file = $this->getServer()['DOCUMENT_ROOT'] . '/Fw/Components/' . $namespace . '/' . $id . '/.class.php';
		$file = __DIR__ . '/../Components/' . $namespace . '/' . $id . '/.class.php';
		$componentFile = $this->fileExists($file);
		$declaredClassesTwo = get_declared_classes();
		$classes = array_diff($declaredClassesTwo, $declaredClassesOne);
		foreach ($classes as $class) {
			$ref = new \ReflectionClass($class);
			if ($ref->getFileName() === $componentFile) {
				$componentClass = $class;
				break;
			}
		}
		if (empty($componentClass)) {
			throw new \RuntimeException('Класс компонента не найден.');
		}
		$this->components[$component] = $componentClass;
		$componentObject = new $componentClass($id, $template, $params);
		$componentObject->executeComponent();
	}
}
