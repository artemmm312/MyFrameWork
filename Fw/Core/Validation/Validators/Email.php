<?php

namespace Fw\Core\Validation\Validators;

//use Fw\Core\Validation\Validator;

class Email extends RegExp
{
	public function __construct(string $rule = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/')
	{
		parent::__construct($rule);
	}
}