<?php
$this->breadcrumbs=array(
	'Drug Plan States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DrugPlanState','url'=>array('index')),
	array('label'=>'Create DrugPlanState','url'=>array('create')),
	array('label'=>'View DrugPlanState','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DrugPlanState','url'=>array('admin')),
	);
	?>

	<h1>Update DrugPlanState <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>