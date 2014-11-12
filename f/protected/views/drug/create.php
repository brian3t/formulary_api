<?php
$this->breadcrumbs=array(
	'Drugs'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Drug','url'=>array('index')),
array('label'=>'Manage Drug','url'=>array('admin')),
);
?>

<h1>Create Drug</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>