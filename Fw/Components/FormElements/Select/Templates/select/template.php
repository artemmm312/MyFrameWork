<?php if (!defined('CORE')) {
	die;
} ?>

<div class="m-3 <?php $this->renderProperty('additional_class') ?>" <?php $this->renderProperty('attr'); ?>>
	<label class="form-check-label" for="<?php $this->renderProperty('id'); ?>">
		<?php $this->renderProperty('title'); ?>
	</label>
	<select class="form-select"
	        id="<?php $this->renderProperty('id'); ?>"
	        <?php $this->renderProperty('multiple') ?>
	        aria-label="<?php $this->renderProperty('aria-label'); ?>">
		
		<?php
		$options = $this->renderProperty('options');
		foreach ($options as $option) {
			echo '<option ' .
				($option['selected'] ? 'selected' : '') .
				' value="' . $option['value'] . '">' . $option['text'] .
				'</option>';
		}
		?>
	
	</select>
</div>
