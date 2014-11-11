<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->breadcrumbs=array(
	'Campaigns'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Campaign', 'url'=>array('index')),
	array('label'=>'Create Campaign', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#campaign-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Campaigns</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/campaign/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Campaign</button></a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'campaign-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'start_date',
		'create_date',
		'end_date',
		'geo',
		'cpc',
		/*
		'mo_budget',
		'device',
		'language',
		'website_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/campaign/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Campaign</button></a>
