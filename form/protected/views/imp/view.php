<?php
$this->breadcrumbs=array(
	'Imps'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Imp','url'=>array('index')),
array('label'=>'Create Imp','url'=>array('create')),
array('label'=>'Update Imp','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Imp','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Imp','url'=>array('admin')),
);
?>

<h1>View Imp #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'ad_id',
		'widget_id',
		'timestamp',
		'ip_address',
		'user_agent',
),
)); ?>
