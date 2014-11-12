<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>
$b = Yii::app()->request->baseUrl;

$this->menu=array(
array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>Create <?php echo $this->modelClass; ?></h1>
<div class="col-md-9">

	<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
</div>
<div class="col-md-3">
	<div class="widget">
		<h3>
			Operations
		</h3>
		<ul class="list-group">
			<li class="list-group-item"><a href="<?="<?=\$b.'/'.get_class(\$model)?>"?>">List <?="<?=get_class(\$model)?>"?></a></li>
			<li class="list-group-item"><a href="<?="<?=\$b.'/'.get_class(\$model)?>"?>/create">Create <?="<?=get_class(\$model)?>"?></a></li>
			<li class="list-group-item"><a href="<?="<?=\$b.'/'.get_class(\$model)?>"?>/admin">Manage <?="<?=get_class(\$model)?>"?>s</a></li>
		</ul>
	</div>
</div>