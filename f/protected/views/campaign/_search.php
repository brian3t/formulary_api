<?php
/* @var $this CampaignController */
/* @var $model Campaign */
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
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'geo'); ?>
		<?php echo $form->textField($model,'geo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'mo_budget'); ?>
		<?php echo $form->textField($model,'mo_budget',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'device'); ?>
		<?php echo $form->textField($model,'device',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'website_id'); ?>
		<?php echo $form->textField($model,'website_id'); ?>
	</div>

	<div class="control-group">class="row">
		<?php echo $form->label($model,'cpc'); ?>
		<?php echo $form->textField($model,'cpc'); ?>
	</div>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->