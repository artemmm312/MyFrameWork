<?php

namespace Fw\Core\Validation\Validators;

use Fw\Core\Validation\Validator;

class RegExp extends Validator
{
	public function __construct(string $rule)
	{
		parent::__construct($rule);
	}
	public function validate($value): bool
	{
		return preg_match($this->rule, $value) === 1;
	}
}