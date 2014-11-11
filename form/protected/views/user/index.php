<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Users',
);
$b = Yii::app()->request->baseUrl;

$this->menu=array(
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Manage User','url'=>array('admin')),
);
$thisClass = get_class($this);
$modelName = substr($thisClass,0, strlen($thisClass) - strlen("Controller"));
?>

<h1>Users</h1>
<div class="col-md-9">

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
