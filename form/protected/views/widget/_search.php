<?php
/* @var $this WidgetController */
/* @var $model Widget */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="control-group ">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'publisher_id'); ?>
		<?php echo $form->textField($model,'publisher_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'website_id'); ?>
		<?php echo $form->textField($model,'website_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'display_options'); ?>
		<?php echo $form->textField($model,'display_options',array('size'=>60,'maxlength'=>800)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'content_options'); ?>
		<?php echo $form->textField($model,'content_options',array('size'=>60,'maxlength'=>800)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'installation_code'); ?>
		<?php echo $form->textField($model,'installation_code',array('size'=>60,'maxlength'=>8000)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'campaign_id'); ?>
		<?php echo $form->textField($model,'campaign_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'placement_id'); ?>
		<?php echo $form->textField($model,'placement_id'); ?>
	</div>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->