<?php
/* @var $this AdController */
/* @var $model Ad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ad-form',
	'htmlOptions' =>
		array(
			'class' => 'form-horizontal',
			'name' => "Ad"),
				// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="control-group">
		<?php echo $form->labelEx($model,'campaign_id',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".$form->dropDownList($model,'campaign_id',CHtml::listData(Campaign::model()->findAll(),'id','name'),array('prompt'=>'Select Campaign')). "</div>"; ?>
		<?php echo $form->error($model,'campaign_id'); ?>
	</div>
<!--	<div class="control-group ">-->
<!--		--><?php //echo $form->labelEx($model,'ad_group_id',array('class'=>'control-label')); ?>
<!--		--><?php //echo "<div class='controls'>".  $form->dropDownList($model,'ad_group_id',CHtml::listData(AdGroup::model()->findAll(),'id','name'),array('prompt'=>'Select Ad Group')). "</div>"; ?>
<!--		--><?php //echo $form->error($model,'ad_group_id'); ?>
<!--	</div>-->
	<div class="control-group ">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'name',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'title',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="control-group ">
		<?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textArea($model,'description',array('cols'=>84)). "</div>"; ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="control-group ">
		<?php echo $form->labelEx($model,'display_url',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'display_url',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'display_url'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'dest_url',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'dest_url',array('size'=>1024,'maxlength'=>1024)). "</div>"; ?>
		<?php echo $form->error($model,'dest_url'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'image_url',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'image_url',array('size'=>1024,'maxlength'=>1024)). "</div>"; ?>
		<?php echo $form->error($model,'image_url'); ?>
	</div>



	<div class="control-group ">
		<?php echo $form->labelEx($model,'cpc',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>".  $form->textField($model,'cpc',array('size'=>45,'maxlength'=>45)). "</div>"; ?>
		<?php echo $form->error($model,'cpc'); ?>
	</div>


	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->