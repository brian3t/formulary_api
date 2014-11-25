<?php
$this->breadcrumbs=array(
	'Drug Plan States'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List DrugPlanState','url'=>array('index')),
array('label'=>'Create DrugPlanState','url'=>array('create')),
array('label'=>'Update DrugPlanState','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete DrugPlanState','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage DrugPlanState','url'=>array('admin')),
);
?>

<h1>View DrugPlanState #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'f_id',
		'state_code',
		'drug_name_param',
		'drug_id',
		'tier_code',
		'additional_info',
		'restriction_code',
),
)); ?>
