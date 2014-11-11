<?php
/* @var $this ImpressionsServedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Impressions Serveds',
);

$this->menu=array(
	array('label'=>'Create ImpressionsServed', 'url'=>array('create')),
	array('label'=>'Manage ImpressionsServed', 'url'=>array('admin')),
);
?>

<h1>Impressions Serveds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
