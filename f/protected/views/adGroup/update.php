<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */

$this->breadcrumbs=array(
	'Ad Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List AdGroup', 'url'=>array('index')),
	array('label'=>'Create AdGroup', 'url'=>array('create')),
	array('label'=>'View AdGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdGroup', 'url'=>array('admin')),
);
?>

<h1>Update AdGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>