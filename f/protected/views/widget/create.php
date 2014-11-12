<?php
/* @var $this WidgetController */
/* @var $model Widget */

$this->breadcrumbs=array(
	'Widgets'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Widget', 'url'=>array('index')),
	array('label'=>'Manage Widget', 'url'=>array('admin')),
);
?>

<h1>Create Widget</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>