<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Drug','url'=>array('index')),
array('label'=>'Create Drug','url'=>array('create')),
array('label'=>'Update Drug','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Drug','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Drug','url'=>array('admin')),
);
?>

<h1>View Drug #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'rxcui',
		'str',
),
)); ?>
