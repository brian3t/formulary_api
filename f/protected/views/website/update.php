<?php
/* @var $this WebsiteController */
/* @var $model Website */

$this->breadcrumbs=array(
	'Websites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Website', 'url'=>array('index')),
	array('label'=>'Create Website', 'url'=>array('create')),
	array('label'=>'View Website', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Website', 'url'=>array('admin')),
);
?>

<h1>Update Website <span class="name"><?php echo $model->name; ?></span></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>