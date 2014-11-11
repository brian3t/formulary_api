<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */

$this->breadcrumbs=array(
	'Ad Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List AdGroup', 'url'=>array('index')),
	array('label'=>'Create AdGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ad-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ad Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/adGroup/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad Group</button></a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ad-group-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'name',
		'group_cpc',
		array(
			'name' => 'campaign_id',
			'value'=> '($data->campaign?$data->campaign->name:"Not Set")'
		),
		'created_on',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/adGroup/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad Group</button></a>
