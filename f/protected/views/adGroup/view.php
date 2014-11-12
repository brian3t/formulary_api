<?php
/* @var $this AdGroupController */
/* @var $model AdGroup */

$this->breadcrumbs=array(
	'Ad Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List AdGroup', 'url'=>array('index')),
	array('label'=>'Create AdGroup','url'=>array('create')),
	array('label'=>'Update AdGroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AdGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdGroup','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Ad Group <i><?= $model->name ?></i></h4>
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
				'name',
				'group_cpc',
				array(
					'label'=>"Campaign",
					'value'=>($model->campaign ? $model->campaign->name : "Not set")),
				'created_on',
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
