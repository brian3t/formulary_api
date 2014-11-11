<?php
/* @var $this ImpressionsServedController */
/* @var $model ImpressionsServed */

$this->breadcrumbs=array(
	'Impressions Serveds'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List ImpressionsServed', 'url'=>array('index')),
	array('label'=>'Create ImpressionsServed','url'=>array('create')),
	array('label'=>'Update ImpressionsServed','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ImpressionsServed','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImpressionsServed','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Impression <i><?= $model->name ?></i></h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                           <a href="javascript:;" class="icon-refresh"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
	</div>
	<div class="widget-body form">
		<?php $this->widget('zii.widgets.CDetailView',array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'advertiser_site_id',
				'advertiser_account_id',
				'adv_campaign_id',
				'adv_ad_group',
				'adv_ad',
				'publisher_placement_id',
				'publisher_account_id',
				'clicked',
			),
		)); ?>
	</div>
</div>
