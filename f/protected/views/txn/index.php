<?php
$this->breadcrumbs=array(
	'Txns',
);

$this->menu=array(
array('label'=>'Create Txn','url'=>array('create')),
array('label'=>'Manage Txn','url'=>array('admin')),
);
?>

<h1>Txns</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
