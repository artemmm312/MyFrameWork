<?php

namespace Fw\Components\View\Form;

use Fw\Core\Component\Base;

class Form extends Base
{
	public function executeComponent(): void
	{
		
		//$this->result = $this->params;
		$this->template->render($this->params);
	}
}
