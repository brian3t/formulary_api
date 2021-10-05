<?php
$this->breadcrumbs=array(
	'CMS Formulary'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CMS Formulary','url'=>array('index')),
array('label'=>'Create CMS Formulary','url'=>array('create')),
array('label'=>'Update CMS Formulary','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CMS Formulary','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CMS Formulary','url'=>array('admin')),
);
?>

<h1>View CMS Formulary #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'formulary_id',
		'drug_name_param',
		'contract_year',
		'rxcui',
		'tier_level_value',
		'quantity_limit_yn',
		'quantity_limit_amount',
		'quantity_limit_days',
),
)); ?>
