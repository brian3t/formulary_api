<?php
/* @var $this CampaignController */
/* @var $model Campaign */

$this->breadcrumbs=array(
	'Campaigns'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Campaign', 'url'=>array('index')),
	array('label'=>'Create Campaign','url'=>array('create')),
	array('label'=>'Update Campaign','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Campaign','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Campaign','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Campaign <i><?= $model->name ?></i></h4>
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
				'name',
				'start_date',
				'create_date',
				'end_date',
				'geo',
				'mo_budget',
				'cpc',
				'device',
				array(
					'label'=>'Website',
					'value'=>$model->website->name
				),
			),
		)); ?>
	</div>
</div>
<a href=<?= bu() ?>/campaign/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create a new Campaign</button>
</a>
<a href=<?= bu() ?>/campaign/update/<?= $model->id ?>>
	<button class="btn">Update this Campaign</button>
</a>
<a href=<?= bu() ?>/campaign/delete/<?= $model->id ?>>
	<button class="btn btn-danger">Delete this Campaign</button>
</a>
