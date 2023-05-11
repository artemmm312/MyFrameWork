<?php

namespace Fw\Components\FormElements\Select;

use Fw\Core\Component\Base;

class Select extends Base
{
	public function executeComponent(): void
	{
		$this->template->render($this->params);
	}
}
