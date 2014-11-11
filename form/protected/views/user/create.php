<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
$b = Yii::app()->request->baseUrl;

$this->menu=array(
//array('label'=>'List User', 'url'=>array('index')),
array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Create User</h1>
<div class="col-md-9">

	<?php $this->renderPartial('_form', array('model'=>$model)); ?></div>
