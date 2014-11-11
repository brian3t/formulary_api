<?php
/* @var $this AdController */
/* @var $model Ad */

$this->breadcrumbs=array(
	'Ads'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Ad', 'url'=>array('index')),
	array('label'=>'Create Ad', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ad-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ads</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/ad/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad</button></a>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ad-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'display_url',
		'dest_url',
		'image_url',
//		'description',
		/*
		'title',
		'cpc',
		'ad_group_id',
		*/
		array(
			'name' => 'ad_group_id',
			'value'=> '$data->adGroup?$data->adGroup->name:"Not set"'
		),
		array(
			'name' => 'campaign_id',
			'header' => 'Campaign',
			'value'=> '$data->campaign->name'
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/ad/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad</button></a>
