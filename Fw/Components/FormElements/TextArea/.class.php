<?php

namespace Fw\Components\FormElements\TextArea;

use Fw\Core\Component\Base;

class TextArea extends Base
{
	public function executeComponent(): void
	{
		$this->template->render($this->params);
	}
}
