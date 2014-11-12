<?php
$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Plan','url'=>array('index')),
array('label'=>'Create Plan','url'=>array('create')),
array('label'=>'Update Plan','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Plan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Plan','url'=>array('admin')),
);
?>

<h1>View Plan #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'f_id',
		'name',
		'origin_url',
		'state_code',
		'is_medicare',
		'is_medicare_char',
),
)); ?>
