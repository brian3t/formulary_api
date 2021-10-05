<?php
$this->breadcrumbs=array(
	'CMS Formulary'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List CMS Formulary','url'=>array('index')),
array('label'=>'Create CMS Formulary','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('drug-plan-state-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage CMS Formulary</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'drug-plan-state-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'formulary_id',
		'contract_year',
		'rxcui',
		'tier_level_value',
		'quantity_limit_amount',
		'quantity_limit_days',
		'created_at',
    'rxcui',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
'enablePagination' => false
)); ?>
