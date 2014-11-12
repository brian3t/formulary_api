<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('f_id')); ?>:</b>
	<?php echo CHtml::encode($data->f_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origin_url')); ?>:</b>
	<?php echo CHtml::encode($data->origin_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_medicare')); ?>:</b>
	<?php echo CHtml::encode($data->is_medicare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_medicare_char')); ?>:</b>
	<?php echo CHtml::encode($data->is_medicare_char); ?>
	<br />


</div>