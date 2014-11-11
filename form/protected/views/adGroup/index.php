<?php
/* @var $this AdGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ad Groups',
);

$this->menu=array(
	array('label'=>'Create AdGroup', 'url'=>array('create')),
	array('label'=>'Manage AdGroup', 'url'=>array('admin')),
);
?>

<h1>Ad Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
