<?php
$this->breadcrumbs=array(
	'Txns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Txn','url'=>array('index')),
	array('label'=>'Create Txn','url'=>array('create')),
	array('label'=>'View Txn','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Txn','url'=>array('admin')),
	);
	?>

	<h1>Update Txn <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>