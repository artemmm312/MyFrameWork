<?php

namespace Fw\Core;

use Exception;
use Fw\Core\Config;

final class Application
{
	private $pager = null; // будет объект класса
	private $template = null; //будет объект класса
	
	public function __construct()
	{
	}
	
	private function startBuffer()
	{
		ob_start();
	}
	
	private function endBuffer()
	{
		$content = ob_get_contents();
		$content = str_replace(['#FW_MACRO_CSS#', '#FW_MACRO_TITLE#', '#FW_MACRO_DESCRIPTION#', '#FW_MACRO_KEYWORDS#'],
			['<link rel="stylesheet" type="text/css" href="style.css">', 'Мой чудесный тайтл', 'Мое описание', 'ключевые слова, мета-тег, SEO'],
			$content);
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
		$template = Config::get('templates/id');
		if ($template === 'main') {
			include __DIR__ . '/../templates/main/header.php';
		}
	}
	
	public function footer()
	{
		$template = Config::get('templates/id');
		if ($template === 'main') {
			include __DIR__ . '/../templates/main/footer.php';
		}
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