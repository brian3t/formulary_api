<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
		'htmlOptions' =>
			array(
				'class' => 'form-horizontal',
				'name' => "User"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'roles',array('class'=>'col-md-6','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'col-md-6','maxlength'=>255)); ?>

            <?php echo $form->textFieldControlGroup($model,'email',array('class'=>'col-md-6','maxlength'=>255)); ?>

            <?php echo $form->passwordFieldControlGroup($model,'password',array('class'=>'col-md-6','maxlength'=>255)); ?>
	<?php echo $form->textFieldControlGroup($model,'roles',array('class'=>'col-md-6')); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'status',array('class'=>'col-md-6')); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'requires_new_password',array('class'=>'col-md-6')); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'reset_token',array('class'=>'col-md-6','maxlength'=>255)); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'login_attempts',array('class'=>'col-md-6')); ?>
<!---->
<!--            --><?php //echo $form->textFieldControlGroup($model,'login_time',array('class'=>'col-md-6')); ?>
<!---->
<!--            --><?php //echo $form->textFieldControlGroup($model,'login_ip',array('class'=>'col-md-6','maxlength'=>32)); ?>
<!---->
<!--            --><?php //echo $form->textFieldControlGroup($model,'activation_key',array('class'=>'col-md-6','maxlength'=>128)); ?>
<!---->
<!--            --><?php //echo $form->textFieldControlGroup($model,'validation_key',array('class'=>'col-md-6','maxlength'=>255)); ?>

            <?php echo $form->textFieldControlGroup($model,'create_time',array('label'=>'Created On','class'=>'col-md-6', 'disabled' => 'disabled')); ?>

<!--            --><?php //echo $form->textFieldControlGroup($model,'update_time',array('class'=>'col-md-6')); ?>
<!---->
<!--            --><?php //echo $form->textFieldControlGroup($model,'salt',array('class'=>'col-md-6','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'account_id',CHtml::listData(Account::model()->findAll(),'id','name'),array('prompt'=>'Select account','label'=>'Account'));; ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->