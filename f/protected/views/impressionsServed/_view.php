<?php
/* @var $this ImpressionsServedController */
/* @var $data ImpressionsServed */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advertiser_site_id')); ?>:</b>
	<?php echo CHtml::encode($data->advertiser_site_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advertiser_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->advertiser_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adv_campaign_id')); ?>:</b>
	<?php echo CHtml::encode($data->adv_campaign_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adv_ad_group')); ?>:</b>
	<?php echo CHtml::encode($data->adv_ad_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adv_ad')); ?>:</b>
	<?php echo CHtml::encode($data->adv_ad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher_placement_id')); ?>:</b>
	<?php echo CHtml::encode($data->publisher_placement_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher_account_id')); ?>:</b>
	<?php echo CHtml::encode($data->publisher_account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clicked')); ?>:</b>
	<?php echo CHtml::encode($data->clicked); ?>
	<br />

	*/ ?>

</div>