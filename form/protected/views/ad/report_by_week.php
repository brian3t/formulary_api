<?php
/* @var $this AdController */
/* @var $model Ad */

$this->breadcrumbs=array(
	'Ads'=>array('index'),
	'Report',
);

$this->menu=array(
//	array('label'=>'List Ad', 'url'=>array('index')),
	array('label'=>'Create Ad','url'=>array('create')),
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

<script>
	var redrawChart = function () {
		highchartyw1.redraw();
		$(window).resize();
	}
	var redrawChartDelay = function () {
		highchartyw1
		setTimeout(redrawChart, 10);
	}
</script>

<h1>Ads Report</h1>


<div class="row-fluid martop"></div>
<a href=<?= bu() ?>/ad/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad</button>
</a>


<?php

// get dates
$scale=1;
$dateFormat='F d -y ';
$dateFormatTS='Y-m-d H:i:s'; //'2014-09-09 19:21:29 ';

$dateFormatReport = 'm/d/Y';

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
		<h4><i class="icon-reorder"></i>Ads reports</h4>
                           <span class="tools">
                           </span>
	</div>
	<div class="row-fluid">
		<div class="span3 offset6 dates">

				<div class="control-group ">
					<label class="control-label" for="start_date">Start Date</label>		<div class="controls">
						<div class="input-append span6">
							<?php
												$this->widget(
													'booster.widgets.TbDatePicker',
													array(
														'name'=>'start_date',
														'options'=>array(
															'format'=>'yyyy-mm-dd',
															'viewformat'=>'yyyy-mm-dd'
														),
														'htmlOptions'=>array('class'=>'col-md-4'),
													));
												?>
							<span class="add-on"><icon class="icon-calendar"></icon></span>
						</div>
					</div>
				</div>

		</div>
		<div class="span2 dates">
			<div class="control-group ">
				<label class="control-label" for="start_date">End Date</label>		<div class="controls">
					<div class="input-append span6">
						<?php
						$this->widget(
							'booster.widgets.TbDatePicker',
							array(
								'name'=>'end_date',
								'options'=>array(
									'format'=>'mm/dd/yyyy',
									'viewformat'=>'mm/dd/yyyy',
								),
								'value' => date($dateFormatReport,strtotime($Date)),

								'htmlOptions'=>array('class'=>'col-md-4'),
							));
						?>
						<span class="add-on"><icon class="icon-calendar"></icon></span>
					</div>
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
							array("gridLineWidth"=>0,

								"labels"=>array(
									"format"=>'{value}',
								),
								'title'=>array('text'=>'Clicks'),
								'min'=>0,
								"opposite"=>"true"

							)
						),
						'series'=>array(
							array('name'=>"Impressions",'data'=>$rawData,
								"yAxis"=>0
							),
							array('name'=>"Clicks",'data'=>$rawTxnData,
								"yAxis"=>1
							),
						)
					)
				)
			);?></div>
	</div>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'ad-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('class'=>'data-table'),
	'enableSorting'=>true,
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>"align-left"),
			'headerHtmlOptions'=>array('class'=>"align-left"),
			'value'=>'$data->name.CHtml::link(" (edit) ","/ad/update/".$data->id)'
		),
		array(
			'header'=>'Impressions',
			'type'=>'raw',
			'value'=>'sizeof($data->imps)'
		),
		array(
			'header'=>'Clicks',
			'type'=>'raw',
			'value'=>'sizeof($data->txns)'
		),
		array(
			'header'=>'CTR',
			'type'=>'raw',
			'value'=>'(sizeof($data->txns)>0?sprintf("%1\$.2f&#37;",sizeof($data->txns)/sizeof($data->imps)*100):"")'
		),
		array(
			'name'=>'cpc',
			'value'=>'"$".sprintf("%1\$.2f",$data->cpc)'
		),
		array(
			'header'=>'Spend',
			'type'=>'raw',
			'value'=>'"$".sprintf("%1\$.2f",sizeof($data->txns)*$data->cpc)'
		),
	),
)); ?>
<div class="row-fluid martop"></div>
<a href=<?= bu() ?>/ad/create>
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Ad</button>
</a>
<script>
	$(document).ready(function () {
		setTimeout(function () {
			$('#website-grid_c1').click();
			$('#website-grid_c1').click();
		}, 200);
	});
</script>