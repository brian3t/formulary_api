<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */
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
		<?php echo $form->label($model,'group_cpc'); ?>
		<?php echo $form->textField($model,'group_cpc',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'campaign_id'); ?>
		<?php echo $form->textField($model,'campaign_id'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
	</div>
	<div class="control-group">class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>
	<div class="control-group  buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->