<?php
$this->breadcrumbs=array(
	'Drug Plan States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DrugFormulary','url'=>array('index')),
	array('label'=>'Create DrugFormulary','url'=>array('create')),
	array('label'=>'View DrugFormulary','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DrugFormulary','url'=>array('admin')),
	);
	?>

	<h1>Update DrugPlanState <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
