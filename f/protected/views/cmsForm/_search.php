<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

<?php echo $form->textFieldGroup($model, 'formulary_id', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>

<?php echo $form->textFieldGroup($model, 'ndc', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 12)))); ?>

<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Search',
    )); ?>
</div>

<?php $this->endWidget(); ?>
