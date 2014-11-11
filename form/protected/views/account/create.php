<?php
/* @var $this AccountController */
/* @var $model Account */

$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>Create Account</h1>

<?php
if (!empty($_REQUEST['error_msg'])){
	$error_msg = $_REQUEST['error_msg'];

$this->widget('ext.widgets.etoastr.EToastr',array(
	'flashMessagesOnly'=>false, //default to false
	'message'=>$error_msg, //because flashOnlyMessages is true
	//the options passed to the plugin
	'options'=>array(
		'positionClass'=>'toast-top-left',
		'fadeOut'   =>  6000,
		'timeOut'   =>  10000,
		'fadeIn'    =>  1000
	)
));
}

$this->renderPartial('_form', array('model'=>$model));
?>