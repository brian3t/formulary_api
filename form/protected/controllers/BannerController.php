<?php
require_once __DIR__.'/../vendor/autoload.php';
use GeoIp2\Database\Reader;

class BannerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'get'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','admin', 'get'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Banner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			$model->attributes=$_POST['Banner'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->banner_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
			$model->attributes=$_POST['Banner'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->banner_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Banner');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Banner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banner']))
			$model->attributes=$_GET['Banner'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banner the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banner $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/*
	 * get a single banner based on ip
	 */
	public function actionGet()
	{
		//get ip address and country

		$reader=new Reader('/home/engine/public_html/assets/maxmind/GeoLite2-City.mmdb');
		$ip = $_SERVER['REMOTE_ADDR'];
		/*
		 * TODO debug mode
		 */
		if ($ip === '127.0.0.1' || empty($ip)){
			$ip='198.2.44.170';
		}
		//end debug mode

		try {$record=$reader->country($ip);}
		catch(AddressNotFoundException $anfe){
			echo '<div style="display:none">Can\'t find Country based on ip. IP address is ' . $ip . '</div>';
			app()->end();
		}
		$countryCode = strtolower(trim($record->country->isoCode));
		//if no country found, return
		if (strlen($countryCode) !== 2){
			echo '<div style="display:none">Country code found not valid: ' . $countryCode . '</div>';
			app()->end();
		}

		//else, lookup db and find banner html
		$countryCodeId = CountryCode::model()->findByAttributes(array('code'=>$countryCode))->getPrimaryKey();

		$banner = Banner::model()->findByAttributes(array('country_code' => $countryCodeId));
		//return banner html
		header("Content-type: text/html");
		echo $banner->htmlcode?$banner->htmlcode:'<div style="display:none">Can\'t find Banner for this country. Country is ' . $countryCodeId . '</div>';
		app()->end();
	}


}
