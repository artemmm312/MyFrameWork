<?php if (!defined('CORE')) {
	die;
} ?>

<div class="mb-3 <?php $this->renderProperty('additional_class') ?>" <?php $this->renderProperty('attr'); ?>>
	<label class="form-label" for="<?php $this->renderProperty('id'); ?>">
		<?php $this->renderProperty('title'); ?>
	</label>
	<textarea class="form-control"
	          id="<?php $this->renderProperty('id'); ?>"
	          rows="<?php $this->renderProperty('rows'); ?>">
	</textarea>
</div>
