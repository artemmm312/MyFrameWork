<?php

namespace Fw\Components\FormElements\Input;

use Fw\Core\Component\Base;

class Input extends Base
{
	public function executeComponent(): void
	{
		$this->template->render($this->params);
	}
}
