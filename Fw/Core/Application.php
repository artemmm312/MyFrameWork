<?php

namespace Fw\Core;

use Fw\Core\Type\Request;
use Fw\Core\Type\Server;
use Fw\Core\Type\Session;

final class Application
{
	private static ?Page $pager = null;
	private $template = null; //будет объект класса
	
	public function __construct()
	{
		InstanceContainer::getInstance(Request::class);
		InstanceContainer::getInstance(Server::class);
		InstanceContainer::getInstance(Session::class);
	}
	
	public function getPage(): Page
	{
		if (empty(self::$pager)) {
			self::$pager = new Page();
		}
		return self::$pager;
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
	
	}
}