<?php
/* @var $this WebsiteController */
/* @var $model Website */

$this->breadcrumbs=array(
	'Websites'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Website', 'url'=>array('index')),
	array('label'=>'Create Website', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#website-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Websites</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/website/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add Website</button></a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'website-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'url',
		array(
			'name' => 'account_id',
			'value'=> '$data->account->name'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/website/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add Website</button></a>
