<?php

namespace Fw\Core;

use Exception;

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
	
	public function endBuffer()
	{
		$content = ob_get_contents();
		$content = str_replace('#FW_MACRO_CSS#', '<link rel="stylesheet" type="text/css" href="style.css">', $content);
		$content = str_replace('#FW_MACRO_TITLE#', 'Мой чудесный тайтл', $content);
		$content = str_replace('#FW_MACRO_DESCRIPTION#', 'Мое описание', $content);
		$content = str_replace('#FW_MACRO_KEYWORDS#', 'ключевые слова, мета-тег, SEO', $content);
		ob_end_clean();
		echo $content;
	}
	
	public function restartBuffer()
	{
		ob_end_clean();
		ob_start();
	}
	
	public function header()
	{
		echo '<head>';
		echo '<title>#FW_MACRO_TITLE#</title>';
		echo '<meta name="description" content="#FW_MACRO_DESCRIPTION#">';
		echo '<meta name="keywords" content="#FW_MACRO_KEYWORDS#">';
		echo '#FW_MACRO_CSS#';
		echo '</head>';
	}
	
	public function footer()
	{
		echo '</body>
			<footer>
				<div>Подвал</div>
			</footer>';
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