<?php
/* @var $this WebsiteController */
/* @var $model Website */

$this->breadcrumbs=array(
	'Websites'=>array('index'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Website', 'url'=>array('index')),
	array('label'=>'Create Website', 'url'=>array('create')),
	array('label'=>'Update Website', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Website', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Website', 'url'=>array('admin')),
);
?>



<div class="widget">
<div class="widget-title">
	<h4><i class="icon-reorder"></i>Website <i><?=$model->name?></i></h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                           <a href="javascript:;" class="icon-refresh"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
</div>
<div class="widget-body form">


	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'name',
			'url',
			'account_id',
		),
	)); ?>

</div>
</div>

<a href=<?=bu()?>/website/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add a new Website</button></a>
<a href=<?=bu()?>/website/update/<?=$model->id?>><button class="btn">Update this Website</button></a>
<a href=<?=bu()?>/website/delete/<?=$model->id?>><button class="btn btn-danger">Delete this Website</button></a>

