<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */

$this->breadcrumbs=array(
	'Impressions Serveds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List ImpressionsServed', 'url'=>array('index')),
	array('label'=>'Create ImpressionsServed', 'url'=>array('create')),
	array('label'=>'View ImpressionsServed', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ImpressionsServed', 'url'=>array('admin')),
);
?>

<h1>Update ImpressionsServed <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>