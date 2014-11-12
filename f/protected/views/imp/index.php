<?php
$this->breadcrumbs=array(
	'Imps',
);

$this->menu=array(
array('label'=>'Create Imp','url'=>array('create')),
array('label'=>'Manage Imp','url'=>array('admin')),
);
?>

<h1>Imps</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
