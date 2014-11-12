<?php $this->beginContent('/layouts/main'); ?>
<?php
$flashMessages=Yii::app()->user->getFlashes();
if($flashMessages) :?>
	<?php foreach ($flashMessages as $key=>$message)  : ?>
		<div class="alert alert-dismissable alert-<?php echo $key; ?>">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?php echo $message; ?></strong>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<?php echo $content; ?>
<!-- Example row of columns -->
<hr>
<?php $this->endContent(); ?>
<?php //cs()->registerCssFile($this->getBootstrap3LayoutCssFileURL()); ?>