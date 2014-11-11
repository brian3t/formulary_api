<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('id')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->email),array('view','id'=>$data->id)); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('team_id')); ?><!--:</b>-->
<!--	--><?php //echo array_reduce(CHtml::listData(Team::model()->findAll(),$data->team_id,'description'), function($carry,$item){$carry .= $item . ' '; return $carry;}); ?>
<!--<!--	--><?php ////echo var_dump(CHtml::listData(Team::model()->findAllByAttributes(array('id' => $data->team_id)),'id','description')); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('roles')); ?>:</b>
	<?php echo CHtml::encode($data->roles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />


	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_strategy')); ?>:</b>
	<?php echo CHtml::encode($data->password_strategy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requires_new_password')); ?>:</b>
	<?php echo CHtml::encode($data->requires_new_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reset_token')); ?>:</b>
	<?php echo CHtml::encode($data->reset_token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_attempts')); ?>:</b>
	<?php echo CHtml::encode($data->login_attempts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_time')); ?>:</b>
	<?php echo CHtml::encode($data->login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_ip')); ?>:</b>
	<?php echo CHtml::encode($data->login_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activation_key')); ?>:</b>
	<?php echo CHtml::encode($data->activation_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validation_key')); ?>:</b>
	<?php echo CHtml::encode($data->validation_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salt')); ?>:</b>
	<?php echo CHtml::encode($data->salt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('license_number')); ?>:</b>
	<?php echo CHtml::encode($data->license_number); ?>
	<br />

	*/ ?>

</div>