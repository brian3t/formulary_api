<?php
$this->breadcrumbs=array(
	'CMS Formulary'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CMS Formulary','url'=>array('index')),
	array('label'=>'Create CMS Formulary','url'=>array('create')),
	array('label'=>'View CMS Formulary','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CMS Formulary','url'=>array('admin')),
	);
	?>

	<h1>Update CMS Formulary <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
