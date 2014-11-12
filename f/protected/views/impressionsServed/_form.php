<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'impressions-served-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'advertiser_site_id'); ?>
		<?php echo $form->textField($model,'advertiser_site_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'advertiser_site_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'advertiser_account_id'); ?>
		<?php echo $form->textField($model,'advertiser_account_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'advertiser_account_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'adv_campaign_id'); ?>
		<?php echo $form->textField($model,'adv_campaign_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'adv_campaign_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'adv_ad_group'); ?>
		<?php echo $form->textField($model,'adv_ad_group',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'adv_ad_group'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'adv_ad'); ?>
		<?php echo $form->textField($model,'adv_ad',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'adv_ad'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'publisher_placement_id'); ?>
		<?php echo $form->textField($model,'publisher_placement_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'publisher_placement_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'publisher_account_id'); ?>
		<?php echo $form->textField($model,'publisher_account_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'publisher_account_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'clicked'); ?>
		<?php echo $form->textField($model,'clicked'); ?>
		<?php echo $form->error($model,'clicked'); ?>
	</div>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->