<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */

$this->breadcrumbs=array(
	'Impressions Serveds'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List ImpressionsServed', 'url'=>array('index')),
	array('label'=>'Create ImpressionsServed', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#impressions-served-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Impressions Serveds</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'impressions-served-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'advertiser_site_id',
		'advertiser_account_id',
		'adv_campaign_id',
		'adv_ad_group',
		'adv_ad',
		/*
		'publisher_placement_id',
		'publisher_account_id',
		'clicked',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
