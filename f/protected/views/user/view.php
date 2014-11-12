<?php
/* @var $this UserController */
/* @var \$model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);
$b = Yii::app()->request->baseUrl;

$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>User <i><?= $model->name ?></i></h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                           <a href="javascript:;" class="icon-refresh"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
	</div>
	<div class="widget-body form"><div class="col-md-9">
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table-striped table-condensed table-hover view-box col-xs-12 col-sm-12 col-md-9 col-lg-9',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'roles',
		'name',
		'account_id',
		'email',
		'status',
		'password_strategy',
		'requires_new_password',
//		'reset_token',
		'login_attempts',
		'login_time',
		'login_ip',
//		'activation_key',
//		'validation_key',
		'create_time',
//		'update_time',
//		'salt',
	),
)); ?>
			</div>
		</div>
</div>
<a href=<?=bu()?>/user/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add a new User</button></a>
<a href=<?=bu()?>/user/update/<?=$model->id?>><button class="btn">Update this User</button></a>
<a href=<?=bu()?>/user/delete/<?=$model->id?>><button class="btn btn-danger">Delete this User</button></a>
