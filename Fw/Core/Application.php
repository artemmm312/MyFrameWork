<?php

namespace Fw\Core;

use Exception;
use Fw\Core\Config;
use Fw\Core\Page;

final class Application
{
	private static ?Page $pager = null; // будет объект класса
	private $template = null; //будет объект класса
	
	public function __construct()
	{
	}
	public function getPage(): Page
	{
		if(empty(self::$pager)) {
			self::$pager = new Page();
		}
		return self::$pager;
	}
	
	private function startBuffer()
	{
		ob_start();
	}
	
	private function endBuffer()
	{
		$content = ob_get_contents();
		$replaceable = $this->getPage()->getAllReplace();
		
		$js = '';
		foreach ($replaceable['js'] as $src) {
			$js .= '<script async src="' . $src . '"></script>';
		}
		$content = str_replace('#FW_MACRO_JS#', $js, $content);
		
		$css = '';
		foreach ($replaceable['css'] as $link) {
			$css .= '<link href="' . $link . '" type="text/css" rel="stylesheet">';
		}
		$content = str_replace('#FW_MACRO_CSS#', $css, $content);
		
		$string = implode('', $replaceable['string']);
		$content = str_replace('#FW_MACRO_STRING#', $string, $content);
		
		foreach ($replaceable['properties'] as $id => $value) {
			$content = str_replace("#FW_PAGE_PROPERTY_$id#", $value, $content);
		}
		
		/*$content = str_replace(['#FW_MACRO_CSS#', '#FW_MACRO_TITLE#', '#FW_MACRO_DESCRIPTION#', '#FW_MACRO_KEYWORDS#'],
			['<link rel="stylesheet" type="text/css" href="style.css">', 'Мой чудесный тайтл', 'Мое описание', 'ключевые слова, мета-тег, SEO'],
			$content);*/
		ob_end_clean();
		echo $content;
	}
	
	public function restartBuffer()
	{
		ob_clean();
	}
	
	public function header()
	{
		$this->startBuffer();
		$template = Config::get('templates/main') . 'header.php';
		if (!file_exists($template)) {
			throw new \Exception("Файл '{$template}' не существует");
		}
		include $template;
	}
	
	public function footer()
	{
		$template = Config::get('templates/main') . 'footer.php';
		if (!file_exists($template)) {
			throw new \Exception("Файл '{$template}' не существует");
		}
		include $template;
		$this->endBuffer();
	}
	
	
	/*	private static ?Application $instance = null;
		private $pager = null; // будет объект класса
		private $template = null; //будет объект класса
		
		private function __construct()
		{
		}
		
		public static function getInstance(): Application
		{
			if (empty(self::$instance)) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		private function __clone()
		{
		}
		
		public function __wakeup(): void
		{
			throw new Exception("Cannot unserialize a singleton.");
		}*/
}