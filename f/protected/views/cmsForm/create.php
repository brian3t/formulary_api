<?php
$this->breadcrumbs=array(
	'CMS Formulary'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CMS Formulary','url'=>array('index')),
array('label'=>'Manage CMS Formulary','url'=>array('admin')),
);
?>

<h1>Create CMS Formulary</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
