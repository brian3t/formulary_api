<?php
/* @var $this UserController */
/* @var $model User */


$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);
$b = Yii::app()->request->baseUrl;

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>
<div class="col-md-12">


	<div class="row-fluid martop"></div>
	<a href=<?=bu()?>/user/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create User</button></a>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid',
		'dataProvider'=>$model->search(),
//		'filter'=>$model,
		'enableSorting'=>false,

		'columns'=>array(
			'name',
			'email',
			'create_time',
			'account_id',
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); ?>
</div>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/user/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create User</button></a>
