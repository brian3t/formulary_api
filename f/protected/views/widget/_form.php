<?php
/* @var $this WidgetController */
/* @var $model Widget */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'widget-form',
	'htmlOptions' =>
		array(
			'class' => 'form-horizontal',
			'name' => "Widget"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'name',array('size'=>60,'maxlength'=>255)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'publisher_id',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->dropDownList($model,'publisher_id',CHtml::listData(Account::model()->findAll(array('condition' => 'isPublisher =1 ;')),'id','name'),array('prompt'=>'Select Publisher')). "</div>"; ?>
		<?php echo $form->error($model,'publisher_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'website_id',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->dropDownList($model,'website_id',CHtml::listData(Website::model()->findAll(array('condition' => '')),'id','name'),array('prompt'=>'Select Website')). "</div>"; ?>
		<?php echo $form->error($model,'website_id'); ?>
	</div>

<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'type',array('size'=>60,'maxlength'=>255)). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'type'); ?>
<!--	</div>-->
<!---->
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'display_options',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'display_options',array('size'=>60,'maxlength'=>800)). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'display_options'); ?>
<!--	</div>-->
<!---->
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'content_options',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'content_options',array('size'=>60,'maxlength'=>800)). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'content_options'); ?>
<!--	</div>-->
<!---->
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'installation_code',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'installation_code',array('size'=>60,'maxlength'=>8000,'readonly'=>true)). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'installation_code'); ?>
<!--	</div>-->
<!---->
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'campaign_id',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'campaign_id'). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'campaign_id'); ?>
<!--	</div>-->
<!---->
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'placement_id',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->textField($model,'placement_id'). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'placement_id'); ?>
<!--	</div>-->

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->