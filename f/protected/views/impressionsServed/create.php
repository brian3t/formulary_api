<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */

$this->breadcrumbs=array(
	'Impressions Serveds'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List ImpressionsServed', 'url'=>array('index')),
	array('label'=>'Manage ImpressionsServed', 'url'=>array('admin')),
);
?>

<h1>Create ImpressionsServed</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>