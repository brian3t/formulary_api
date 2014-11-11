<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>Account created</h1>

<p>Thank you for signing up with BRAX! An user has been created for your account. Please check your email at <code><?php echo $_REQUEST['user_email']; ?></code> for login information.</p>
