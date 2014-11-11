<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Create Account','url'=>array('create')),
	array('label'=>'Update Account','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Account','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Account','url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Account <i><?= $model->name ?></i></h4>
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
				'isAdvertiser:boolean',
				'isPublisher:boolean',
			),
		)); ?>

	</div>
</div>
<a href=<?= bu() ?>/account/update/<?= $model->id ?>>
	<button class="btn">Update your Account</button>
</a>
