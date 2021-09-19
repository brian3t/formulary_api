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

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_year')); ?>:</b>
	<?php echo CHtml::encode($data->contract_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rxcui')); ?>:</b>
	<?php echo CHtml::encode($data->rxcui); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ndc')); ?>:</b>
	<?php echo CHtml::encode($data->ndc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tier_level_value')); ?>:</b>
	<?php echo CHtml::encode($data->tier_level_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_limit_yn')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_limit_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_limit_amount')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_limit_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_limit_days')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_limit_days); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('restriction_code')); ?>:</b>
	<?php echo CHtml::encode($data->restriction_code); ?>
	<br />

	*/ ?>

</div>
