<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="form" xmlns="http://www.w3.org/1999/html">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'account-form',
		'htmlOptions' =>
		array(
		'class' => 'form-horizontal',
		'name' => "Account"),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'name',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'isAdvertiser',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->checkBox($model,'isAdvertiser'). "</div>"; ?>
		<?php echo $form->error($model,'isAdvertiser'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'isPublisher',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->checkBox($model,'isPublisher'). "</div>"; ?>
		<?php echo $form->error($model,'isPublisher'); ?>
	</div>
	<?php
	if($model->isNewRecord):?>
		<div class="control-group ">
			<?php echo $form->labelEx($model,'user_email',array('class'=>'control-label')); ?>
			<div class="controls"><input name="user_email" id="user_email" type="text"/></div>
		</div>
	<?php
	endif;

	?>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget();
?>


</div><!-- form -->