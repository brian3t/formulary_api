<?php
/* @var $this AdController */
/* @var $model Ad */

$this->breadcrumbs=array(
	'Campaign'=>array('index'),
	'Report',
);

$this->menu=array(
//	array('label'=>'List Ad', 'url'=>array('index')),
//	array('label'=>'Create Ad','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search',"
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ad-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Campaign Report</h1>


<!--<div class="row-fluid martop"></div>-->
<!--<a href=--><?//= bu() ?><!--/ad/create>-->
<!--	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad</button>-->
<!--</a>-->


<?php

// get dates
$scale=1;
$dateFormat='F d -y ';
$dateFormatTS='Y-m-d H:i:s'; //'2014-09-09 19:21:29 ';

$Date=date($dateFormat);
$dateFormatEvent='Y-m-d';
$DateEvent=date($dateFormatEvent);

$firstDateOfMonth=date('Y-1-01');
$lastDateOfMonth=date('Y-m-d');

/*
 * init series array
 */
//array(
//	array('name' => 'Jane', 'data' => array(1, 0, 4)),
//	array('name' => 'John', 'data' => array(5, 7, 3))
//)
$datesArray=array(
	date($dateFormat,strtotime($Date . ' - 28 days')),
	date($dateFormat,strtotime($Date . ' - 21 days')),
	date($dateFormat,strtotime($Date . ' - 14 days')),
	date($dateFormat,strtotime($Date . ' - 7 days')),
	date($dateFormat,strtotime($Date))
);
$impSeriesArray=array();
$txnSeriesArray=array();
$adsArray=array();
//get all ads of current account
$currUser=User::model()->findByPk(app()->user->id);
$currAcc=$currUser->account;//TODO account doesn't have websites
$websites=$currAcc->websites;
foreach ($websites as $w)
{
	foreach ($w->campaigns as $c)
	{
		foreach ($c->ads as $a)
		{
			array_push($adsArray,$a);
		}
	}
}
$imp=Imp::model();
$txn=Txn::model();

$allAdIdsString=array();
foreach ($adsArray as $aa)
{
	array_push($allAdIdsString,$aa->id);
};

$rawData=array();
$criteria=new CDbCriteria();
$criteria->select="count(*)";
$criteria->condition="timestamp <= :date_to and timestamp > :date_from";
$criteria->params=array(
	':date_from'=>date($dateFormatTS,strtotime($Date . ' - 35 days')),
	':date_to'=>date($dateFormatTS,strtotime($Date . ' - 28 days'))
);
$criteria->addInCondition('ad_id',$allAdIdsString);
$count=$imp->count($criteria);

array_push($rawData,$count * $scale);


$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 28 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 21 days'));
$count=$imp->count($criteria);
array_push($rawData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 21 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 14 days'));
$count=$imp->count($criteria);
array_push($rawData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 14 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 7 days'));
$count=$imp->count($criteria);
array_push($rawData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 7 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 0 days'));
$count=$imp->count($criteria);
array_push($rawData,$count * $scale);

$graphData=array('name'=>"Impressions",'data'=>$rawData);

array_push($impSeriesArray,$graphData);

//txn data
$rawTxnData=array();

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 28 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 21 days'));
$count=$txn->count($criteria);

array_push($rawTxnData,$count * $scale);


$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 28 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 21 days'));
$count=$txn->count($criteria);
array_push($rawTxnData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 21 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 14 days'));
$count=$txn->count($criteria);
array_push($rawTxnData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 14 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 7 days'));
$count=$txn->count($criteria);
array_push($rawTxnData,$count * $scale);

$criteria->params[':date_from']=date($dateFormatTS,strtotime($Date . ' - 7 days'));
$criteria->params[':date_to']=date($dateFormatTS,strtotime($Date . ' - 0 days'));
$count=$txn->count($criteria);
array_push($rawTxnData,$count * $scale);

$graphData=array('name'=>"Clicks",'data'=>$rawTxnData);






?>
<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Campaign reports</h4>
                           <span class="tools">
                           </span>
	</div>
	<div class="row-fluid">
		<div class="span6 offset5">

			<div class="">
				<div id="form-date-range" class="report-range-container">
					<i class="icon-calendar icon-large"></i><span>August 25, 2014 - September 23, 2014</span> <b
						class="caret"></b>
				</div>
			</div>
		</div>
	</div>
	<div class="widget-body">
		<div class="tabbable portlet-tabs">
			<?php
			$this->widget(
				'yiiwheels.widgets.highcharts.WhHighCharts',
				array(
					'pluginOptions'=>array(
						'title'=>array('text'=>''),
						'xAxis'=>array(
							'categories'=>$datesArray
						),
						'yAxis'=>array(
							array(
								"labels"=>array(
									"format"=>'{value}',
									"style"=>array(
										"color"=>"#7cb5ec"
									)
								),
								'title'=>array('text'=>'Impressions'),
								'min'=>0,
							),
							array(            "gridLineWidth"=> 0,

								"labels"=>array(
									"format"=>'{value}',
								),
								'title'=>array('text'=>'Clicks'),
								'min'=>0,
								"opposite" => "true"

							)
						),
						'series'=>array(
							array('name'=>"Impressions",'data'=>$rawData,
								"yAxis"=> 0
							),
							array('name'=>"Clicks",'data'=>$rawTxnData,
								"yAxis"=> 1
							),
						)
					)
				)
			);?></div>
	</div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'campaign-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name.CHtml::link(" (edit) ","/campaign/update/".$data->id)'
		),
		array(
			'header' => 'Impressions',
			'type' => 'raw',
			'value'=> 'Yii::app()->createController("Website")[0]->countImps($data->website->id) '
		),
		array(
			'header' => 'Clicks',
			'type' => 'raw',
			'value'=> 'Yii::app()->createController("Website")[0]->countClicks($data->id) '
		),
		array(
			'header' => 'CTR (%)',
			'type' => 'raw',
			'value'=> 'sprintf("%1\$.2f",Yii::app()->createController("Website")[0]->countCTR($data->id)*100) '
		),
		array(
			'header' => 'CPC',
			'type' => 'raw',
			'value'=> '"$".Yii::app()->createController("Website")[0]->countCPC($data->id)'
		),
		array(
			'header' => 'Spend',
			'type' => 'raw',
			'value'=> 'Yii::app()->createController("Website")[0]->countSpend($data->id) '
		),
		array(
			'header' => 'Budget',
			'type' => 'raw',
			'value'=> '"$".Yii::app()->createController("Website")[0]->countBudget($data->id) '
		),
		array(
			'header' => 'Remaining',
			'type' => 'raw',
			'value'=> '"$".strval(Yii::app()->createController("Website")[0]->countBudget($data->id) - Yii::app()->createController("Website")[0]->countSpend($data->id));'
		),

	),
)); ?>
<div class="row-fluid martop"></div>

<script>
	$(document).ready(function () {
		setTimeout(function(){$('#website-grid_c1').click();$('#website-grid_c1').click();},200);
	});
</script>