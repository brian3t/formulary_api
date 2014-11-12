<?php
$this->breadcrumbs=array(
	'Txns'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Txn','url'=>array('index')),
array('label'=>'Manage Txn','url'=>array('admin')),
);
?>

<h1>Create Txn</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>