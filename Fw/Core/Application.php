<?php

namespace Fw\Core;

final class Application
{
	private static ?Page $pager = null;
	private $template = null; //будет объект класса
	
	public function __construct()
	{
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
}