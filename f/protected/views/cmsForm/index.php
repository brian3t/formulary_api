<?php
$this->breadcrumbs=array(
	'CMS Formulary',
);

$this->menu=array(
array('label'=>'Create CMS Formulary','url'=>array('create')),
array('label'=>'Manage CMS Formulary','url'=>array('admin')),
);
?>

<h1>CMS Formulary</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
