<?php

namespace Fw\Core\Validation\Validators;

use Fw\Core\Validation\Validator;

class Phone extends RegExp
{
	public function __construct(string $rule = '/^\+?\d{1,3}\s?\(\d{3}\)\s?\d{1,3}[-\s]?\d{2}[-\s]?\d{2}$/')
	{
		parent::__construct($rule);
	}
}