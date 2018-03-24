<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<link href="/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet"/>
<link href="/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet"/>
<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
<link href="/assets/css/style.css" rel="stylesheet"/>
<link href="/assets/css/style_responsive.css" rel="stylesheet"/>
<link href="/assets/css/style_default.css" rel="stylesheet" id="style_color"/>
<link href="#" rel="stylesheet" id="style_metro"/>
<link href="/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="/assets/gritter/css/jquery.gritter.css"/>
<!--<link rel="stylesheet" type="text/css" href="/assets/uniform/css/uniform.default.css"/>-->
<link rel="stylesheet" type="text/css" href="/assets/chosen-bootstrap/chosen/chosen.css"/>
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-timepicker/compiled/timepicker.css"/>
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" href="/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css"/>
<link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="/assets/bootstrap-daterangepicker/daterangepicker.css"/>


<?php
$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>

<div class="container-fluid">
	<!-- BEGIN PAGE HEADER-->
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				Register
				<small>Please sign up to contribute medical formulary information. Thank you</small>
			</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> <span class="divider">/</span>
				</li>
				<li><a href="#">Register</a></li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div id="page">

		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN  FORM PORTLET-->
				<div class="widget">
					<div class="widget-title">
						<h4><i class="icon-reorder"></i>Register</h4>
                           <span class="tools">
                           <a href="javascript:;" class="icon-chevron-down"></a>
                           <a href="#widget-config" data-toggle="modal" class="icon-wrench"></a>
                           <a href="javascript:;" class="icon-refresh"></a>
                           <a href="javascript:;" class="icon-remove"></a>
                           </span>
					</div>
					<div class="widget-body form">
						<!-- BEGIN FORM-->
						<?php $form=$this->beginWidget('CActiveForm',array(
							'enableClientValidation'=>true,
							//'enableAjaxValidation'=>true,
							// 'errorMessageCssClass'=>'has-error',
							'htmlOptions'=>array('class'=>'form-horizontal',
								'role'=>'form',
								'id'=>'register-form'
							),
							'clientOptions'=>array(
								'id'=>'register-form',
								'validateOnSubmit'=>true,
								'errorCssClass'=>'has-error',
								'successCssClass'=>'has-success',
								'inputContainer'=>'.form-group',
								'validateOnChange'=>true
							),
						));
						?>

						<div class="control-group">
							<div class="col-lg-3 control-label">
								<div>
									<p class="note">Fields with <span class="required">*</span> are required.</p>
								</div>
							</div>
							<div class="col-lg-5  has-error">
								<div class="help-inline ">
									<?php echo $form->errorSummary($model); ?>
								</div>
							</div>
						</div>


						<div class="control-group">
							<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
							<div
								class="controls"> <?php echo $form->textField($model,'email',array('class'=>'col-md-6','placeholder'=>'Email')); ?>
							</div>
							<span class="help-inline ">
                			<?php echo $form->error($model,'email'); ?>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'username',array('class'=>' control-label')); ?>
							<div
								class="controls"><?php echo $form->textField($model,'username',array('class'=>'col-md-6','placeholder'=>'Choose a username')); ?>
							</div><div class="help-inline">
								<?php echo $form->error($model,'username'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'new_password',array('class'=>' control-label')); ?>
							<div
								class="controls"><?php echo $form->passwordField($model,'new_password',array('class'=>'col-md-6','placeholder'=>'Choose your password')); ?>
							</div><div class="help-inline">
								<?php echo $form->error($model,'new_password'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $form->labelEx($model,'password_confirm',array('class'=>' control-label')); ?>
							<div
								class="controls"><?php echo $form->passwordField($model,'password_confirm',array('type'=>'password','class'=>'col-md-6','placeholder'=>'Confirm your password','rows'=>6,'cols'=>50)); ?>
							</div><div class="help-inline">
								<?php echo $form->error($model,'password_confirm'); ?>
							</div>
						</div>

<!--						<div class="control-group">-->
<!--							<label for="RegisterForm_verify_code" class="control-label">Captcha</label> <input-->
<!--								name="RegisterForm[verify_code]" id="RegisterForm_verify_code" type="hidden">-->
<!--							<div-->
<!--								class="controls"><script type="text/javascript"-->
<!--									src="http://api.recaptcha.net/challenge?k=6Le_pPsSAAAAAOzdoxVXkxfG09K3ILNdFj6UobSS"></script>-->
<!--							<script type="text/javascript"-->
<!--									src="http://www.google.com/recaptcha/api/js/recaptcha.js"></script>-->
<!--							<div id="recaptcha_widget_div" style=""-->
<!--								 class=" recaptcha_nothad_incorrect_sol recaptcha_isnot_showing_audio">-->
<!--								<div id="recaptcha_area"></div>-->
<!--							</div>-->
<!--							<script type="text/javascript"-->
<!--									src="http://www.google.com/recaptcha/api/js/recaptcha.js"></script>-->
<!--							<div id="recaptcha_widget_div" style="display:none"></div>-->
<!--							<div id="recaptcha_widget_div"-->
<!--								 class=" recaptcha_nothad_incorrect_sol recaptcha_isnot_showing_audio ">-->
<!--								<div id="recaptcha_area">-->
<!--								</div>-->
<!--							</div>-->
<!--								</div>-->
<!---->
<!--							<noscript>-->
<!--								&amp;lt;iframe-->
<!--								src="http://api.recaptcha.net/noscript?k=6Le_pPsSAAAAAOzdoxVXkxfG09K3ILNdFj6UobSS"-->
<!--								height="300" width="500" frameborder="0"&amp;gt;&amp;lt;/iframe&amp;gt;&amp;lt;br/&amp;gt;-->
<!--								&amp;lt;textarea name="recaptcha_challenge_field" rows="3" cols="40"&amp;gt;&amp;lt;/textarea&amp;gt;-->
<!--								&amp;lt;input type="hidden" name="recaptcha_response_field" value="manual_challenge"/&amp;gt;-->
<!--							</noscript>-->
<!--							<div class="help-inline">-->
<!--							</div>-->
<!--						</div>-->

						<div class="control-group">
							<div class="col-lg-offset-3 col-lg-10">
								<?php echo CHtml::submitButton('Sign Up',array('class'=>'btn btn-primary btn-lg')); ?>
							</div>
						</div>
						<!-- END FORM-->
					</div>
				</div>
				<?php $this->endWidget(); ?>
				<!-- END SAMPLE FORM PORTLET-->
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>
<!-- END CONTAINER -->

<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script src="/assets/js/jquery-1.8.2.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/bootstrap/js/bootstrap-fileupload.js"></script>
<script src="/assets/js/jquery.blockui.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="/assets/js/excanvas.js"></script>
<script src="/assets/js/respond.js"></script>
<![endif]-->
<script type="text/javascript" src="/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<!--<script type="text/javascript" src="/assets/uniform/jquery.uniform.min.js"></script>-->
<script type="text/javascript" src="/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<!--<script src="/assets/js/app.js"></script>-->

<script>
	jQuery(document).ready(function () {
		// initiate layout and plugins
//		App.init();
//		$('#recaptcha_widget_div').addClass('float-left');
	});
</script>
<!-- END JAVASCRIPTS -->


