<?php
/* @var $this AdController */
/* @var $model Ad */
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
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'display_url'); ?>
		<?php echo $form->textField($model,'display_url',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'dest_url'); ?>
		<?php echo $form->textField($model,'dest_url',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'image_url'); ?>
		<?php echo $form->textField($model,'image_url',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'cpc'); ?>
		<?php echo $form->textField($model,'cpc',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'ad_group_id'); ?>
		<?php echo $form->textField($model,'ad_group_id'); ?>
	</div>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->