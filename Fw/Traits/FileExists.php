<?php

namespace Fw\Traits;
trait FileExists
{
	public function fileExists(string $file): string|false
	{
		if (!file_exists($file)) {
			throw new \RuntimeException("Файл '{$file}' не существует");
		}
		$file = realpath($file);
		include_once $file;
		return $file;
	}
}
