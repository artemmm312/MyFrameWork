<?php

namespace Fw\Core\Type;

use Traversable;

class Dictionary implements \Iterator, \ArrayAccess, \Countable, \JsonSerializable
{
	
	private int $position = 0;
	
	//protected array $values;
	
	public function __construct(protected array $values, protected bool $readonly = false)
	{
	}
	
	public function current(): mixed
	{
		return $this->values[$this->position];
	}
	
	public function next(): void
	{
		$this->position++;
	}
	
	public function key(): mixed
	{
		return $this->position;
	}
	
	public function valid(): bool
	{
		return isset($this->values[$this->position]);
	}
	
	public function rewind(): void
	{
		$this->position = 0;
	}
	
	public function offsetExists(mixed $offset): bool
	{
		return isset($this->values[$offset]);
	}
	
	public function offsetGet(mixed $offset): mixed
	{
		return $this->values[$offset];
	}
	
	public function offsetSet(mixed $offset, mixed $value): void
	{
		$this->values[$offset] = $value;
	}
	
	public function offsetUnset(mixed $offset): void
	{
		unset($this->values[$offset]);
	}
	
	public function count(): int
	{
		return count($this->values);
	}
	
	public function jsonSerialize(): mixed
	{
		return [
			'position' => $this->position,
			'values' => $this->values,
			'readonly' => $this->readonly,
		];
	}
	
	public function get($name): mixed //возвращает значение по ключу
	{
		return $this->values[$name];
	}
	
	public function set($name, $value): void  //устанавливает значение по ключу
	{
		if (!$this->readonly) {
			$this->values[$name] = $value;
		}
	}
	
	public function getValues(): array
	{
		return $this->values;
	}
	
	public function setValues($values): void
	{
		if (!$this->readonly) {
			$this->values = $values;
		}
	}
	
	public function clear(): void
	{
		$this->values = [];
	}
}