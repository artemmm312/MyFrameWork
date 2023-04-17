<?php

namespace Fw\Core;

class Test
{
	private string $a;
	private string $b;
	
	public function __construct(string $a, string $b)
	{
		$this->a = $a;
		$this->b = $b;
	}
	
	public function get()
	{
		return $this->a . $this->b;
	}
}