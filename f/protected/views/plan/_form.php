<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'plan-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'formulary_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->textFieldGroup($model,'contract_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>800)))); ?>

	<?php echo $form->textFieldGroup($model,'state',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
