<?php

namespace Fw\Components\View\Main;

use Fw\Core\Component\Base;

class MainComponent extends Base
{
	public function executeComponent(): void
	{
		$this->result = $this->params;
		$this->template->render($this->result);
	}
}
