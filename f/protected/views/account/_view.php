<?php
/* @var $this AccountController */
/* @var $data Account */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isAdvertiser')); ?>:</b>
	<?php echo CHtml::checkBox("Is Advertiser",$data->isAdvertiser, array('disabled' => 'disabled')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPublisher')); ?>:</b>
	<?php echo CHtml::checkBox("Is Publisher",$data->isPublisher,array('disabled' => 'disabled')); ?>
	<br />


</div>