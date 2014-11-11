<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ad-group-form',
	'htmlOptions' =>
		array(
			'class' => 'form-horizontal',
			'name' => "Ad Group"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="control-group ">
		<?php echo $form->labelEx($model,'campaign_id',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->dropDownList($model,'campaign_id',CHtml::listData(Campaign::model()->findAll(),'id','name'),array('prompt'=>'Select Campaign')). "</div>"; ?>
		<?php echo $form->error($model,'campaign_id'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".$form->textField($model,'name',array('size'=>60,'maxlength'=>500)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'group_cpc',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'group_cpc',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'group_cpc'); ?>
	</div>


	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->