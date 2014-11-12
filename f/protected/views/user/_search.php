<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('class'=>'col-md-6')); ?>

                    <?php echo $form->textFieldControlGroup($model,'roles',array('class'=>'col-md-6','maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name',array('class'=>'col-md-6','maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'email',array('class'=>'col-md-6','maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status',array('class'=>'col-md-6')); ?>

                    <?php echo $form->textFieldControlGroup($model,'login_attempts',array('class'=>'col-md-6')); ?>

                    <?php echo $form->textFieldControlGroup($model,'login_time',array('class'=>'col-md-6')); ?>

                    <?php echo $form->textFieldControlGroup($model,'login_ip',array('class'=>'col-md-6','maxlength'=>32)); ?>

                    <?php echo $form->textFieldControlGroup($model,'activation_key',array('class'=>'col-md-6','maxlength'=>128)); ?>

                    <?php echo $form->textFieldControlGroup($model,'validation_key',array('class'=>'col-md-6','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'create_time',array('class'=>'col-md-6')); ?>
	<?php echo $form->textFieldControlGroup($model,'account_id',array('class'=>'col-md-6')); ?>


        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->