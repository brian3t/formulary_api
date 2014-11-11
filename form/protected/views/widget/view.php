<style>
	tr.inst_code > td:hover {
		opacity: 0.5;
		background-color: #eee
	}
</style>
<?php
/* @var $this WidgetController */
/* @var $model Widget */

$this->breadcrumbs=array(
	'Widgets'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Widget', 'url'=>array('index')),
	array('label'=>'Create Widget','url'=>array('create')),
	array('label'=>'Update Widget','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Widget','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Widget','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Widget <i><?= $model->name ?></i></h4>
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
				'publisher_id',
				'website_id',
				'type',
				'display_options',
				'content_options',
				array('label'=>"Installation Code",
					'value'=>$model->installation_code,
					'cssClass'=>'inst_code'
				),
				'campaign_id',
				'placement_id',
			),
		)); ?>
	</div>
</div>
<a href=<?= bu() ?>/widget/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create a new Widget</button>
</a>
<a href=<?= bu() ?>/widget/update/<?= $model->id ?>>
	<button class="btn">Update this Widget</button>
</a>
<a href=<?= bu() ?>/widget/delete/<?= $model->id ?>>
	<button class="btn btn-danger">Delete this Widget</button>
</a>
