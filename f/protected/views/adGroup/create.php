<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */

$this->breadcrumbs=array(
	'Ad Groups'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List AdGroup', 'url'=>array('index')),
	array('label'=>'Manage AdGroup', 'url'=>array('admin')),
);
?>

<h1>Create AdGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>