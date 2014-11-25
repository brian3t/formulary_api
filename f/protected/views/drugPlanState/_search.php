<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

		<?php echo $form->textFieldGroup($model,'f_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

		<?php echo $form->textFieldGroup($model,'state_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); ?>

		<?php echo $form->textFieldGroup($model,'drug_name_param',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2000)))); ?>

		<?php echo $form->textFieldGroup($model,'drug_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

		<?php echo $form->textFieldGroup($model,'tier_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

		<?php echo $form->textFieldGroup($model,'additional_info',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2500)))); ?>

		<?php echo $form->textFieldGroup($model,'restriction_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
