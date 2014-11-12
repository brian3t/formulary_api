<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Create Banner', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#banner-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Banners</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php $uid = app()->user->id;?>
<p>
	After you have entered all HTML codes for each banner, put this code to your website (wordpress widget / joomla widget / magento block):
	<textarea id="code-snippet" class="gwt-TextArea code-snippet gwt-TextArea-readonly" cols="65" rows="12" readonly="" dir="ltr">
		<div id='ian<?=$uid?>'></div>
		<script type='text/javascript'>
			(function() {
				var params =
				{
					id: '<?=$uid?>'
				};
				var qs='';
				for(var key in params){qs+=key+'/'+params[key]+'&'}
				qs=qs.substring(0,qs.length-1);
				var s = document.createElement('script');
				s.type= 'text/javascript';
				s.src = '<?=app()->getBaseUrl()?>/banner/get/' + qs;
				s.async = true;
				document.getElementById('ian<?=$uid?>').appendChild(s);
			})();
		</script>'
	</textarea>

</p>


<div class="row-fluid martop"></div>
<a href=<?=bu()?>/banner/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Banner</button></a>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'banner-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'banner_id',
		'name',
//		'country_code',
		array(
			'name' => 'country_code',
			'value'=> '$data->countryCode->country_name'
		),
		'htmlcode',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php app()->clientScript->registerScript('clipboard',"	 $('#code-snippet').click(function(){console.log('what');$(this).select();});

");

?>
<div class="row-fluid martop"></div>
<a href=<?=bu()?>/banner/create><button class="btn btn-warning"><i class="icon-plus icon-white"></i> Create Banner</button></a>
