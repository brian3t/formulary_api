<?php
/* @var $this BannerController */
/* @var $data Banner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->banner_id)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('country_code')); ?>:</b>
	<?php echo CHtml::encode($data->countryCode->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('htmlcode')); ?>:</b>
	<?php echo CHtml::encode($data->htmlcode); ?>
	<br />


</div>