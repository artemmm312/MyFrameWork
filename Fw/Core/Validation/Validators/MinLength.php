<?php

namespace Fw\Core\Validation\Validators;

use Fw\Core\Validation\Validator;

class MinLength extends Validator
{
	public function __construct(int $rule)
	{
		parent::__construct($rule);
	}
	
	public function validate($value): bool
	{
		if(is_array($value)) {
			return count($value) >= $this->rule;
		}
		if(is_string($value)) {
			return strlen($value) >= $this->rule;
		}
		return false;
	}
}