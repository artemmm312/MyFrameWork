<?php

namespace Fw\Core;

class Page
{
	private string $title = '';
	private string $description = '';
	private string $keywords = '';
	private array $js = [];
	private array $css = [];
	private array $string = [];
	private array $properties = [];
	private array $macros =
		[
			'head' =>
				[
					'title' => "#FW_MACRO_TITLE#",
					'description' => "#FW_MACRO_DESCRIPTION#",
					'keywords' => "#FW_MACRO_KEYWORDS#",
					'js' => "#FW_MACRO_JS#",
					'css' => "#FW_MACRO_CSS#",
					'string' => "#FW_MACRO_STRING#",
				],
			'property' => '#FW_PAGE_PROPERTY_'
		];
	
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}
	
	public function setDescription(string $description): void
	{
		$this->description = $description;
	}
	
	public function setKeywords(string $keywords): void
	{
		$this->keywords = $keywords;
	}
	
	public function addJs(string $src): void  //добавляет src в массив сохраняя уникальность
	{
		$this->js[md5($src)] = $src;
	}
	
	public function addCss(string $link): void  //добавляет link сохраняя уникальность
	{
		$this->css[md5($link)] = $link;
	}
	
	public function addString(string $str): void  // добавляет в массив для хранения
	{
		$this->string[] = $str;
	}
	
	public function showTitle(): void
	{
		echo $this->macros['head']['title'];
	}
	
	public function showDescription(): void
	{
		echo $this->macros['head']['description'];
	}
	
	public function showKeywords(): void
	{
		echo $this->macros['head']['keywords'];
	}
	
	public function showHead(): void // выводит 3 макроса замены CSS / STR / JS
	{
		echo $this->macros['head']['js'];
		echo $this->macros['head']['css'];
		echo $this->macros['head']['string'];
	}
	
	public function setProperty(string $id, string $value): void // добавляет для хранения
	{
		$this->properties[$id] = $value;
	}
	
	public function getProperty(string $id): string
	{
		return $this->properties[$id];
	}
	
	public function showProperty(string $id): void  // выводит макрос для будущей замены
	{
		if (empty($this->properties[$id])) {
			$this->setProperty($id, '');
		}
		echo $this->macros['property'] . $id . '#';
	}
	
	public function getAllReplace(string $content): string
	{
		$js = '';
		if (!empty($this->js)) {
			$js = implode(PHP_EOL, $this->js) . PHP_EOL;
		}
		$css = '';
		if (!empty($this->css)) {
			$css = implode(PHP_EOL, $this->css) . PHP_EOL;
		}
		$string = '';
		if (!empty($this->string)) {
			$string = implode(PHP_EOL, $this->string);
		}
		$searchHead = [];
		foreach ($this->macros['head'] as $macro) {
			$searchHead[] = $macro;
		}
		$replaceHead = [$this->title, $this->description, $this->keywords, $js, $css, $string];
		$content = str_replace($searchHead, $replaceHead, $content);
		
		foreach ($this->properties as $id => $value) {
			$property = $this->macros['property'] . $id . '#';
			$content = str_replace($property, $value, $content);
		}
		return $content;
	}
}
