<?php if (!defined('CORE')) {
	die;
} ?>

<div class="form-check m-3 <?php $this->renderProperty('additional_class'); ?>" <?php $this->renderProperty('attr'); ?>>
	<input class="form-check-input"
	       id="<?php $this->renderProperty('id'); ?>"
	       type="checkbox"
	       value="<?php $this->renderProperty('value'); ?>"
	       <?php $this->renderProperty('attr'); ?>>
	<label class="form-check-label" for="<?php $this->renderProperty('id'); ?>">
		<?php $this->renderProperty('title'); ?>
	</label>
</div>
