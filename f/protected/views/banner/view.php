<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Create Banner','url'=>array('create')),
	array('label'=>'Update Banner','url'=>array('update','id'=>$model->banner_id)),
	array('label'=>'Delete Banner','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->banner_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Banner','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Banner <i><?= $model->name ?></i></h4>
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
//		'banner_id',
				'name',
				array(
					'label'=>'Country Code',
					'value'=>$model->countryCode->code
				),
				'htmlcode',
			),
		)); ?>
	</div>
</div>
<a href=<?= bu() ?>/banner/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create a new Banner</button>
</a>
<a href=<?= bu() ?>/banner/update/<?= $model->id ?>>
	<button class="btn">Update this Banner</button>
</a>
<a href=<?= bu() ?>/banner/delete/<?= $model->id ?>>
	<button class="btn btn-danger">Delete this Banner</button>
</a>
