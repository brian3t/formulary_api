<?php
/* @var $this AdController */
/* @var $data Ad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_url')); ?>:</b>
	<?php echo CHtml::encode($data->display_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dest_url')); ?>:</b>
	<?php echo CHtml::encode($data->dest_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image_url')); ?>:</b>
	<?php echo CHtml::encode($data->image_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campaign_id')); ?>:</b>
	<?php echo CHtml::encode($data->campaign->name); ?>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cpc')); ?>:</b>
	<?php echo CHtml::encode($data->cpc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->ad_group_id); ?>
	<br />

	*/ ?>

</div>