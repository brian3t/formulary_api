<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Drug','url'=>array('index')),
	array('label'=>'Create Drug','url'=>array('create')),
	array('label'=>'View Drug','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Drug','url'=>array('admin')),
	);
	?>

	<h1>Update Drug <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>