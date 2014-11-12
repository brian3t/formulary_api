<?php
$this->breadcrumbs=array(
	'Imps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Imp','url'=>array('index')),
	array('label'=>'Create Imp','url'=>array('create')),
	array('label'=>'View Imp','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Imp','url'=>array('admin')),
	);
	?>

	<h1>Update Imp <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>