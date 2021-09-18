<?php
$this->breadcrumbs=array(
	'Drug Plan States',
);

$this->menu=array(
array('label'=>'Create DrugPlanState','url'=>array('create')),
array('label'=>'Manage DrugPlanState','url'=>array('admin')),
);
?>

<h1>Drug Plan States</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
