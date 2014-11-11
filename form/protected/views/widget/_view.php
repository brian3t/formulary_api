<?php
/* @var $this WidgetController */
/* @var $data Widget */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher_id')); ?>:</b>
	<?php echo CHtml::encode($data->publisher_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_id')); ?>:</b>
	<?php echo CHtml::encode($data->website_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_options')); ?>:</b>
	<?php echo CHtml::encode($data->display_options); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_options')); ?>:</b>
	<?php echo CHtml::encode($data->content_options); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('installation_code')); ?>:</b>
	<?php echo CHtml::encode($data->installation_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campaign_id')); ?>:</b>
	<?php echo CHtml::encode($data->campaign_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placement_id')); ?>:</b>
	<?php echo CHtml::encode($data->placement_id); ?>
	<br />

	*/ ?>

</div>