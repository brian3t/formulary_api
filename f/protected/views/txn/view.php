<?php
$this->breadcrumbs=array(
	'Txns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Txn','url'=>array('index')),
	array('label'=>'Create Txn','url'=>array('create')),
	array('label'=>'Update Txn','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Txn','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Txn','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Txn <i><?= $model->name ?></i></h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                           <a href="javascript:;" class="icon-refresh"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
	</div>
	<div class="widget-body form">
		<?php $this->widget('booster.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'ad_id',
				'widget_id',
				'timestamp',
				'ip_address',
				'user_agent',
			),
		)); ?>
	</div>
</div>
