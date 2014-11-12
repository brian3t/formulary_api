<?php
/* @var $this CampaignController */
/* @var $data Campaign */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geo')); ?>:</b>
	<?php echo CHtml::encode($data->geo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mo_budget')); ?>:</b>
	<?php echo CHtml::encode($data->mo_budget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpc')); ?>:</b>
	<?php echo CHtml::encode($data->cpc); ?>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('device')); ?>:</b>
	<?php echo CHtml::encode($data->device); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_id')); ?>:</b>
	<?php echo CHtml::encode($data->website_id); ?>
	<br />

	*/ ?>

</div>