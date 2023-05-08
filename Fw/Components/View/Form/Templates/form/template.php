<?php if (!defined('CORE')) {
	die;
} ?>

<form class="<?php $this->renderProperty('additional_class') ?>"
      method="<?php $this->renderProperty('method'); ?>"
      action="<?php $this->renderProperty('action'); ?>"
      <?php $this->renderProperty('attr'); ?>>
	
	<?php
	foreach ($this->params['elements'] as $element) {
		$this->app->includeComponent($element['component'], $element['template'], $element['params']);
	}
	?>

</form>
