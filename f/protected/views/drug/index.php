<?php
$this->breadcrumbs=array(
	'Drugs',
);

$this->menu=array(
array('label'=>'Create Drug','url'=>array('create')),
array('label'=>'Manage Drug','url'=>array('admin')),
);
?>

<h1>Drugs</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
