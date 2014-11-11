<?php
/* @var $this WebsiteController */
/* @var $model Website */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'website-form',
	'htmlOptions' =>
		array(
			'class' => 'form-horizontal',
			'name' => "Website"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="control-group ">
		<?php echo $form->labelEx($model,'account_id',array('class'=>'control-label')); ?>
<!--		--><?php
		$accs = Account::model()->findAll();

		echo "<div class='controls'>". $form->dropDownList($model,'account_id',CHtml::listData($accs,'id',function($accs){return $accs->id." - ".$accs->name;}),array('class'=>'span3','prompt'=>'Select a Account')). "</div>"; ?>

		<?php echo $form->error($model,'account_id'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'name',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'url',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'url',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'url'); ?>
	</div>


	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->