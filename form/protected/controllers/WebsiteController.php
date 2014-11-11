<?php

class WebsiteController extends Controller
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
			array('allow',
				'actions'=>array('admin'),
				'roles'=>array('admin'),
			),
			array('allow',
				'actions'=>array('report','wreport'),
				'roles'=>array('publisher'),
			),
			array('allow',
				'actions'=>array('report','wreport'),
				'roles'=>array('advertiser'),
			),
            array('allow',
                'actions'=>array('index'),
                'roles'=>array('publisher', 'advertiser'),
            ),
            array('allow',
                'actions'=>array('view'),
                'roles'=>array('publisher', 'advertiser'),
            ),
            array('allow',
                'actions'=>array('create'),
                'roles'=>array('publisher', 'advertiser'),
            ),
            array('allow',
                'actions'=>array('update'),
                'roles'=>array('publisher', 'advertiser'),
            ),
            array('allow',
                'actions'=>array('delete'),
                'roles'=>array('publisher', 'advertiser'),
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
		$model=new Website;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Website']))
		{
			$model->attributes=$_POST['Website'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Report view.
	 */
	public function actionReport()
	{
		$model=new Website('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Website']))
			$model->attributes=$_GET['Website'];

		$this->render('report',array(
			'model'=>$model,
		));
	}
	/**
	 * Widgets Report view.
	 */
	public function actionWreport()
	{
		$model=new Website('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Website']))
			$model->attributes=$_GET['Website'];

		$wmodel = Widget::model();
		$this->render('wreport',array(
			'model'=>$model,
			'wmodel' => $wmodel

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

		if(isset($_POST['Website']))
		{
			$model->attributes=$_POST['Website'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Website');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Website('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Website']))
			$model->attributes=$_GET['Website'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Website the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Website $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='website-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function countImps($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			return 0;
		$count = 0;
		foreach ($model->widgets as $widget){
			$count+= sizeof($widget->imps);
		}
		return $count;
	}
	public function countClicks($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			return 0;
		$count = 0;
		foreach ($model->widgets as $widget){
			$count+= sizeof($widget->txns);
		}
		return $count;
	}
	public function countCTR($id)
	{
		if (self::countImps($id) === 0){
			return "N/A";
		}
		return self::countClicks($id) / self::countImps($id);
	}
	public function countCPC($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			return "N/A";
		$cpc = 0;
		$count = 0;
		foreach ($model->campaigns as $c)
		{
			$cpc = ($cpc + $c->cpc);
			$count++;
		}
		return ($count === 0?"0":$cpc/$count);
	}
	public function countBudget($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			return "N/A";
		$b = 0;
		$count = 0;
		foreach ($model->campaigns as $c)
		{
			$b = ($b + $c->mo_budget);
			$count++;
		}
		return ($count === 0?"0":sprintf("%01.2f",$b/$count));
	}
	public function countSpend($id)
	{
		$model=Website::model()->findByPk($id);
		if($model===null)
			return 0;
		return self::countClicks($id) * self::countCPC($id);
	}
}
