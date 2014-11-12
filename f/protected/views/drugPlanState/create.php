<?php
$this->breadcrumbs=array(
	'Drug Plan States'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List DrugPlanState','url'=>array('index')),
array('label'=>'Manage DrugPlanState','url'=>array('admin')),
);
?>

<h1>Create DrugPlanState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>