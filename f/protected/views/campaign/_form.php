<?php
/* @var $this CampaignController */
/* @var $model Campaign */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'campaign-form',
		'htmlOptions'=>
			array(
				'class'=>'form-horizontal',
				'name'=>"Campaign"),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		</div>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="control-group ">
		<?php echo $form->labelEx($model,'website_id',array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->dropDownList($model,'website_id',CHtml::listData(Website::model()->findAll(),'id','name'),array('class'=>'span3','prompt'=>'Select a Website')); ?>
		</div>        <?php echo $form->error($model,'website_id'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'start_date',array('class'=>'control-label')); ?>
		<div class='controls'>
			<div class="input-append span6">

				<?php
				$this->widget(
					'booster.widgets.TbDatePicker',
					array(
						'name'=>'Campaign[start_date]',
						'options'=>array(
							'format'=>'yyyy-mm-dd',
							'viewformat'=>'yyyy-mm-dd'
						),
						'htmlOptions'=>array('class'=>'col-md-4'),
					));
				?>
				<span class="add-on"><icon class="icon-calendar"></icon></span>
			</div>
		</div>
	</div>

	<!--	<div class="control-group ">-->
	<!--		--><?php //echo $form->labelEx($model,'create_date'); ?>
	<!--		<div class="input-append">-->
	<!--			--><?php //$this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
	//				'name' => 'Campaign[create_date]',
	//				'id' => 'Campaign_create_date',
	//				'pluginOptions' => array(
	//					'format' => 'yyyy-mm-dd',
	//					'type' => 'date',
	//				),
	//				'value' => $model->create_date
	//			));
	//
	?>
	<!--			<span class="add-on"><icon class="icon-calendar"></icon></span>-->
	<!--		</div>-->
	<!--		--><?php //echo $form->error($model,'create_date'); ?>
	<!--	</div>-->

	<div class="control-group ">
		<?php echo $form->labelEx($model,'end_date',array('class'=>'control-label')); ?>
		<div class='controls'>
			<div class="input-append span6">
				<?php
				$this->widget(
					'booster.widgets.TbDatePicker',
					array(
						'name'=>'Campaign[end_date]',
						'options'=>array(
							'format'=>'yyyy-mm-dd',
							'viewformat'=>'yyyy-mm-dd'
						),
						'htmlOptions'=>array('class'=>'col-md-4'),
					));
				?>
				<span class="add-on"><icon class="icon-calendar"></icon></span>
			</div>
		</div>
		<?php echo $form->error($model,'end_date'); ?>
	</div>


	<div class="control-group ">
		<?php echo $form->labelEx($model,'mo_budget',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>" .
			'<div class="input-prepend input-append">' .
			'<span class="add-on">$</span>' .
			$form->textField($model,'mo_budget',array('size'=>45,'maxlength'=>45)) .
			'<span class="add-on">.00</span>' .
			'</div>
		</div>';?>
		<?php echo $form->error($model,'mo_budget'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'cpc',array('class'=>'control-label')); ?>
		<?php echo "<div class='controls'>" . $form->textField($model,'cpc') . "</div>"; ?>
		<?php echo $form->error($model,'cpc'); ?>
	</div>
	<div class="control-group ">
		<?php echo $form->labelEx($model,'geo',array('class'=>'control-label'));
		$cons=CountryCode::model()->findAll();
		echo "<div class='controls'>" . $form->dropDownList($model,'geo',CHtml::listData($cons,'country_code_id',function ($con)
			{
				return $con->country_name;
			}),array('class'=>'span3','prompt'=>'Select a Geography Location')) . "</div>"; ?>
		<?php echo $form->error($model,'geo'); ?>
	</div>

	<div class="control-group ">
		<?php echo $form->labelEx($model,'device',array('class'=>'control-label'));
		echo "<div class='controls'>" . $form->dropDownList($model,'device',array("All","Tablet","Mobile","Desktop"),array('class'=>'span3','prompt'=>'Select targeting Device')) . "</div>"; ?>
		<?php echo $form->error($model,'device'); ?>
	</div>


	<div class="control-group  buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
