<?php

namespace Fw\Core\Validation\Validators;

use Fw\Core\Validation\Validator;

class Number extends Validator
{
	public function __construct($rule = null)
	{
		parent::__construct($rule);
	}
	
	public function validate($value): bool
	{
		return is_int($value) || is_float($value);
	}
}