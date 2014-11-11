<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */
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
		<?php echo $form->label($model,'advertiser_site_id'); ?>
		<?php echo $form->textField($model,'advertiser_site_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'advertiser_account_id'); ?>
		<?php echo $form->textField($model,'advertiser_account_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'adv_campaign_id'); ?>
		<?php echo $form->textField($model,'adv_campaign_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'adv_ad_group'); ?>
		<?php echo $form->textField($model,'adv_ad_group',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'adv_ad'); ?>
		<?php echo $form->textField($model,'adv_ad',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'publisher_placement_id'); ?>
		<?php echo $form->textField($model,'publisher_placement_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'publisher_account_id'); ?>
		<?php echo $form->textField($model,'publisher_account_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->label($model,'clicked'); ?>
		<?php echo $form->textField($model,'clicked'); ?>
	</div>

	<div class="control-group  buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->