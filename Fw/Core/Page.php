<?php

namespace Fw\Core;

class Page
{
	private array $js = [];
	private array $css = [];
	private array $string = [];
	
	private array $properties = [];
	
	public function addJs(string $src)  //добавляет src в массив сохраняя уникальность
	{
		$this->js[] = $src;
	}
	
	public function addCss(string $link)  //добавляет link сохраняя уникальность
	{
		$this->css[] = $link;
	}
	
	public function addString(string $str)  // добавляет в массив для хранения
	{
		$this->string[] = $str;
	}
	
	public function setProperty(string $id, mixed $value) // добавляет для хранение
	{
		$this->properties[$id] = $value;
	}
	
	public function getProperty(string $id)  // получение по ключу
	{
		return $this->properties[$id];
	}
	
	public function showProperty(string $id)  // выводит макрос для будущей замены
	{
		echo "#FW_PAGE_PROPERTY_$id#";
	}
	
	public function getAllReplace() // получает массив макросов и значений для замены
	{
		return
			[
				'js' => $this->js,
				'css' => $this->css,
				'string' => $this->string,
				'properties' => $this->properties,
			];
		//return $this->properties;
	}
	
	public function showHead() // выводит 3 макроса замены CSS / STR / JS
	{
		echo "#FW_MACRO_JS#";
		echo "#FW_MACRO_CSS#";
		echo "#FW_MACRO_STRING#";
	}
}

