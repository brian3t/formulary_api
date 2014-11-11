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

$dateFormatReport='m-d-Y';

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
$datesArray=array();
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
$criteria->params=array();

if(isset($_GET['end_date']))
{
	$end_date = DateTime::createFromFormat('m-d-Y', $_GET['end_date']);
	$end_date  = $end_date->format($dateFormatTS);
} else
{
	$end_date=$Date;
}
if(isset($_GET['start_date']))
{
	$start_date = DateTime::createFromFormat('m-d-Y', $_GET['start_date']);
	$start_date = $start_date->format($dateFormatTS);
} else
{
	$start_date=date($dateFormatTS,strtotime($Date . ' - 28 days'));
}


/*loop through all days*/
$currDay = $start_date;
while (strtotime($currDay) < strtotime($end_date))
{
	$criteria->params[':date_from']=date($dateFormatTS,strtotime($currDay . ' - 1 days'));
	$criteria->params[':date_to']=date($dateFormatTS,strtotime($currDay . ' - 0 days'));
	$count=$imp->count($criteria);
	array_push($rawData,$count * $scale);
	$currDay = date($dateFormatTS,strtotime($currDay . ' + 1 day'));

	$dayNum = strtolower(date("d",strtotime($currDay)));
	if ($dayNum == 1 || $dayNum == 15){
		array_push($datesArray,date('d-M',strtotime($currDay)));
	}
	else{
		array_push($datesArray,date('d',strtotime($currDay)));
	}
}
/*end loop through all days */

$graphData=array('name'=>"Impressions",'data'=>$rawData);

array_push($impSeriesArray,$graphData);

//txn data
$rawTxnData=array();

/*loop through all days*/
$currDay = $start_date;
while (strtotime($currDay) < strtotime($end_date))
{
	$criteria->params[':date_from']=date($dateFormatTS,strtotime($currDay . ' - 1 days'));
	$criteria->params[':date_to']=date($dateFormatTS,strtotime($currDay . ' - 0 days'));
	$count=$txn->count($criteria);
	array_push($rawTxnData,$count * $scale);
	$currDay = date($dateFormatTS,strtotime($currDay . ' + 1 day'));

}
/*end loop through all days */

$graphData=array('name'=>"Clicks",'data'=>$rawTxnData);

array_push($txnSeriesArray,$graphData);



?>
<div class="widget">
	<div class="widget-title">
		<h4><i class="icon-reorder"></i>Campaign reports</h4>
                           <span class="tools">
                           </span>
	</div>
	<div class="row-fluid">
		<div class="span3 offset6 dates">

			<div class="control-group ">
				<label class="control-label" for="start_date">Start Date</label>

				<div class="controls">
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
								'value'=>($start_date?date($dateFormatReport,strtotime($start_date)):null),
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
				<label class="control-label" for="start_date">End Date</label>

				<div class="controls">
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
								'value'=>date($dateFormatReport,strtotime($Date)),

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
<a class="fixwidth" href="/ce/campaign/create">
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add Campaign</button>
</a>
&nbsp;
<a href="#">
	<button id="buttonExport" class="btn btn-warning"> Export Report</button>
</a>
<label class="show-inactive">
	<div class="checker" id="uniform-undefined"><div><input type="checkbox" value="" style="opacity: 0;"></div></div> Show Inactive Campaigns
</label>
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'campaign-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('class'=>'data-table'),
	'enableSorting'=>true,
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'htmlOptions'=>array('class'=>"align-left"),
			'headerHtmlOptions'=>array('class'=>"align-left"),
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
<a class="fixwidth" href="/ce/campaign/create">
	<button class="btn btn-warning"><i class="icon-plus icon-white"></i> Add Campaign</button>
</a>
<div class="row-fluid martop"></div>

<script>
	var bu = '<?= Yii::app()->getBaseUrl().'/'. app()->getController()->id.'/'.app()->getController()->getAction()->id ?>';

	$(document).ready(function () {
		setTimeout(function(){$('#website-grid_c1').click();$('#website-grid_c1').click();},200);
		$('#start_date').change(function(){
			window.location.replace(bu + '/start_date/'+$('#start_date').val().replace(/\//g,"-") + '/end_date/'+$('#end_date').val().replace(/\//g,"-"));
		});
		$('#end_date').change(function(){
			window.location.replace(bu + '/start_date/'+$('#start_date').val().replace(/\//g,"-") + '/end_date/'+$('#end_date').val().replace(/\//g,"-"));
		});
		$('#buttonExport').click(function () {
			highchartyw2.exportChart({
				type: 'application/pdf',
				filename: 'campaign-report-brax-pdf'
			}, {subtitle: {text: ''}});
		});
	});
</script>