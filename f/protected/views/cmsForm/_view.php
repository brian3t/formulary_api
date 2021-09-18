<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formulary_id')); ?>:</b>
	<?php echo CHtml::encode($data->formulary_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formulary_version')); ?>:</b>
	<?php echo CHtml::encode($data->formulary_version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug_name_param')); ?>:</b>
	<?php echo CHtml::encode($data->drug_name_param); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug_id')); ?>:</b>
	<?php echo CHtml::encode($data->drug_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tier_code')); ?>:</b>
	<?php echo CHtml::encode($data->tier_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_info')); ?>:</b>
	<?php echo CHtml::encode($data->additional_info); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('restriction_code')); ?>:</b>
	<?php echo CHtml::encode($data->restriction_code); ?>
	<br />

	*/ ?>

</div>
