<?php
/* @var $this WidgetController */
/* @var $model Widget */

$this->breadcrumbs=array(
	'Widgets'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Widget', 'url'=>array('index')),
	array('label'=>'Create Widget', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#widget-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Widgets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/widget/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Widget</button></a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'widget-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'publisher_id',
		'website_id',
		'type',
		'display_options',
		/*
		'content_options',
		'installation_code',
		'campaign_id',
		'placement_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/widget/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Widget</button></a>
