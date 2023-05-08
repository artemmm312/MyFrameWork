<?php if (!defined('CORE')) {
	die;
} ?>

<div class="m-3 <?php $this->renderProperty('additional_class'); ?>" <?php $this->renderProperty('attr'); ?>>
	<label class="form-label" for="<?php $this->renderProperty('id'); ?>">
		<?php $this->renderProperty('title'); ?>
	</label>
	<input class="form-control"
	       id="<?php $this->renderProperty('id'); ?>"
	       type="text"
	       name="<?php $this->renderProperty('name'); ?>"
	       placeholder="<?php $this->renderProperty('placeholder'); ?>">
</div>
