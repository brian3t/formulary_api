<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'banner-form',
	'htmlOptions' =>
		array(
			'class' => 'form-horizontal',
			'name' => "Banner"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'country_code',array('class'=>'control-label')); ?>
		<?php
		$cons = CountryCode::model()->findAll();
		echo "<div class='controls'>". $form->dropDownList($model,'country_code',CHtml::listData($cons,'country_code_id',function($con){return $con->code."-".$con->country_name;}),array('class'=>'span3','prompt'=>'Select a Country Code')). "</div>"; ?>
		<?php echo $form->error($model,'country_code'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".$form->textField($model,'name',array('size'=>60, 'maxlength'=>255)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'htmlcode',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".$form->textArea($model,'htmlcode',array('size'=>6, 'rows'=>20)). "</div>"; ?>
		<?php echo $form->error($model,'htmlcode'); ?>
	</div>

	<div class="row buttons controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->