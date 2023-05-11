<?php

namespace Fw\Core\Validation;

abstract class Validator
{
	protected mixed $rule = null; // правило для валидации
	public function __construct(mixed $rule)
	{
		$this->rule = $rule;
	}
	abstract public function validate($value): bool;
}