<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productndc')); ?>:</b>
	<?php echo CHtml::encode($data->productndc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nonproprietaryname')); ?>:</b>
	<?php echo CHtml::encode($data->nonproprietaryname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('substancename')); ?>:</b>
	<?php echo CHtml::encode($data->substancename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active_numerator_strength')); ?>:</b>
	<?php echo CHtml::encode($data->active_numerator_strength); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active_ingred_unit')); ?>:</b>
	<?php echo CHtml::encode($data->active_ingred_unit); ?>
	<br />


</div>
