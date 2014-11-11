<?php
$this->breadcrumbs=array(
	'Imps'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Imp','url'=>array('index')),
array('label'=>'Manage Imp','url'=>array('admin')),
);
?>

<h1>Create Imp</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>