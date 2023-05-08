<?php

namespace Fw\Components\FormElements\Check;

use Fw\Core\Component\Base;

class Check extends Base
{
	public function executeComponent(): void
	{
		$this->template->render($this->params);
	}
}
