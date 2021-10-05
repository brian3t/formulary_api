<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rxcui')); ?>:</b>
	<?php echo CHtml::encode($data->productndc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('str')); ?>:</b>
	<?php echo CHtml::encode($data->str); ?>
	<br />

</div>
