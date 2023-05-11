<?php

namespace Fw\Core\Validation\Validators;

use Fw\Core\Validation\Validator;

class InList extends Validator
{
	public function __construct(array $rule)
	{
		parent::__construct($rule);
	}
	
	public function validate($value): bool
	{
		foreach ($this->rule as $key) {
			if ($key === $value) {
				return true;
			}
		}
		return false;
	}
}