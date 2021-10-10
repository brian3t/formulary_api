<?php
$this->breadcrumbs=array(
	'Drug Plan States',
);

$this->menu=array(
array('label'=>'Create DrugFormulary','url'=>array('create')),
array('label'=>'Manage DrugFormulary','url'=>array('admin')),
);
?>

<h1>Drug Plan States</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
