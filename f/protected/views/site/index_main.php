<!--
Template Name: Conquer Responsive Admin Dashboard Template build with Twitter Bootstrap 2.2.2
Version: 1.2
Author: KeenThemes
Website: http://www.keenthemes.com
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838
-->

<!-- BEGIN BODY -->
<!-- BEGIN CONTAINER -->
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div id="widget-config" class="modal hide">
	<div class="modal-header">
		<button data-dismiss="modal" class="close" type="button">×</button>
		<h3>Widget Settings</h3>
	</div>
	<div class="modal-body">
		<p>Here will be a configuration form</p>
	</div>
</div>
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN PAGE CONTAINER-->
<div class="container-fluid">
<!-- BEGIN PAGE HEADER-->
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Dashboard
			<small>statistics and more</small>
		</h3>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="#">Home</a> <span class="divider">/</span>
			</li>
			<li><a href="#">Dashboard</a></li>
			<li class="pull-right dashboard-report-li">
				<div id="dashboard-report-range" class="dashboard-report-range-container no-text-shadow tooltips" data-placement="top" data-original-title="Change dashboard date range"><i class="icon-calendar icon-large"></i><span></span>
					<b class="caret"></b>
				</div>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div id="page" class="dashboard">
<!-- BEGIN OVERVIEW STATISTIC BARS-->
<div class="row-fluid stats-overview-cont">
	<div class="span2 responsive" data-tablet="span4" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat ok huge">
				<span class="line-chart">5, 6, 7, 11, 14, 10, 15, 19, 15, 2</span>
				<div class="percent">+66%</div>
			</div>
			<div class="details">
				<div class="title">Users</div>
				<div class="numbers">1360</div>
			</div>
			<div class="progress progress-info">
				<div class="bar" style="width: 66%"></div>
			</div>
		</div>
	</div>
	<div class="span2 responsive" data-tablet="span4" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat good huge">
				<span class="line-chart">2,6,8,12, 11, 15, 16, 11, 16, 11, 10, 3, 7, 8, 12, 19</span>
				<div class="percent">+16%</div>
			</div>
			<div class="details">
				<div class="title">Site Visits</div>
				<div class="numbers">1800</div>
				<div class="progress progress-warning">
					<div class="bar" style="width: 16%"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="span2 responsive " data-tablet="span4" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat bad huge">
				<span class="line-chart">2,6,8,11, 14, 11, 12, 13, 15, 12, 9, 5, 11, 12, 15, 9,3</span>
				<div class="percent">+6%</div>
			</div>
			<div class="details">
				<div class="title">Orders</div>
				<div class="numbers">509</div>
				<div class="progress progress-success">
					<div class="bar" style="width: 16%"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="span2 responsive " data-tablet="span4 fix-margin" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat good huge">
				<span class="bar-chart">1,4,9,12, 10, 11, 12, 15, 12, 11, 9, 12, 15, 19, 14, 13, 15</span>
				<div class="percent">+86%</div>
			</div>
			<div class="details">
				<div class="title">Revenue</div>
				<div class="numbers">1550</div>
				<div class="progress progress-warning">
					<div class="bar" style="width: 56%"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="span2 responsive " data-tablet="span4" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat ok huge">
				<span class="line-chart">2,6,8,12, 11, 15, 16, 17, 14, 12, 10, 8, 10, 2, 4, 12, 19</span>
				<div class="percent">+72%</div>
			</div>
			<div class="details">
				<div class="title">Sales</div>
				<div class="numbers">9600</div>
				<div class="progress progress-danger">
					<div class="bar" style="width: 72%"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="span2 responsive" data-tablet="span4" data-desktop="span2">
		<div class="stats-overview block clearfix">
			<div class="display stat bad huge">
				<span class="line-chart">1,7,9,11, 14, 12, 6, 7, 4, 2, 9, 8, 11, 12, 14, 12, 10</span>
				<div class="percent">+15%</div>
			</div>
			<div class="details">
				<div class="title">Stock</div>
				<div class="numbers">2090</div>
				<div class="progress progress-success">
					<div class="bar" style="width: 15%"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END OVERVIEW STATISTIC BARS-->
<div class="row-fluid">
	<div class="span8">
		<!-- BEGIN SITE VISITS PORTLET-->
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-signal"></i>Site Visits</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
									<a href="javascript:;" class="icon-refresh"></a>
									<a href="javascript:;" class="icon-remove"></a>
									</span>
			</div>
			<div class="widget-body">
				<div id="site_statistics_loading">
					<img src="/assets/img/loading.gif" alt="loading" />
				</div>
				<div id="site_statistics_content" class="hide">
					<div class="btn-toolbar no-top-space clearfix">
						<div class="btn-group" data-toggle="buttons-radio">
							<button class="btn btn-mini">Asia</button><button class="btn btn-mini">Europe</button><button class="btn btn-mini">USA</button>
						</div>
						<div class="btn-group pull-right" data-toggle="buttons-radio">
							<button class="btn btn-mini active">Sales</button><button class="btn btn-mini">
								<span class="visible-phone">In</span>
								<span class="hidden-phone">Income</span>
							</button><button class="btn btn-mini">Stock</button>
						</div>
					</div>
					<div id="site_statistics" class="chart"></div>
				</div>
			</div>
		</div>
		<!-- END SITE VISITS PORTLET-->
	</div>
	<div class="span4">
		<!-- BEGIN NOTIFICATIONS PORTLET-->
		<div class="widget">
			<div class="widget-title">
				<h4><i class="icon-bell"></i>Notifications</h4>
									<span class="tools">
									<a href="javascript:;" class="icon-chevron-down"></a>
									<a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
									<a href="javascript:;" class="icon-refresh"></a>
									</span>
			</div>
			<div class="widget-body">
				<ul class="item-list scroller padding" data-height="307" data-always-visible="1">
					<li>
						<span class="label label-success"><i class="icon-bell"></i></span>
						<span>New user registered.</span>
						<span class="small italic">Just now</span>
					</li>
					<li>
						<span class="label label-success"><i class="icon-bell"></i></span>
						<span>New order received.</span>
						<span class="small italic">15 mins ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Alerting a user account balance.</span>
						<span class="small italic">2 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Alerting administrators staff.</span>
						<span class="small italic">11 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Messages are not sent to users.</span>
						<span class="small italic">14 hrs ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Web server #12 failed to relosd.</span>
						<span class="small italic">2 days ago</span>
					</li>
					<li>
						<span class="label label-success"><i class="icon-bell"></i></span>
						<span>New order received.</span>
						<span class="small italic">15 mins ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Alerting a user account balance.</span>
						<span class="small italic">2 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Alerting administrators support staff.</span>
						<span class="small italic">11 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Messages are not sent to users.</span>
						<span class="small italic">14 hrs ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Web server #12 failed to relosd.</span>
						<span class="small italic">2 days ago</span>
					</li>
					<li>
						<span class="label label-success"><i class="icon-bell"></i></span>
						<span>New order received.</span>
						<span class="small italic">15 mins ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Alerting a user account balance.</span>
						<span class="small italic">2 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Alerting administrators support staff.</span>
						<span class="small italic">11 hrs ago</span>
					</li>
					<li>
						<span class="label label-important"><i class="icon-bolt"></i></span>
						<span>Messages are not sent to users.</span>
						<span class="small italic">14 hrs ago</span>
					</li>
					<li>
						<span class="label label-warning"><i class="icon-bullhorn"></i></span>
						<span>Web server #12 failed to relosd.</span>
						<span class="small italic">2 days ago</span>
					</li>
				</ul>
				<div class="space5"></div>
				<a href="#" class="pull-right">View all notifications</a>
				<div class="clearfix no-top-space no-bottom-space"></div>
			</div>
		</div>
		<!-- END NOTIFICATIONS PORTLET-->
	</div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->

