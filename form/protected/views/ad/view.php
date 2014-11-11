<?php
/* @var $this AdController */
/* @var $model Ad */

$this->breadcrumbs=array(
	'Ads'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Ad', 'url'=>array('index')),
	array('label'=>'Create Ad','url'=>array('create')),
	array('label'=>'Update Ad','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Ad','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ad','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Ad <i><?= $model->name ?></i></h4>
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
//		'id',
				'name',
				array(
					'label'=>'Campaign',
					'value'=>$model->campaign->name
				),
				'display_url',
				'dest_url',
				'image_url',
				array(
					'label'=>'Html Code',
					'type'=>'raw',
					'value'=>$model->description
				),
				'title',
				'cpc',
				'ad_group_id',
			),
		)); ?>
	</div>
</div>

<a href=<?= bu() ?>/ad/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create a new Ad</button>
</a>
<a href=<?= bu() ?>/ad/update/<?= $model->id ?>>
	<button class="btn">Update this Ad</button>
</a>
<a href=<?= bu() ?>/ad/delete/<?= $model->id ?>>
	<button class="btn btn-danger">Delete this Ad</button>
</a>
