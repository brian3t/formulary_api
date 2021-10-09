<?php

class PlanController extends Controller
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
				'actions'=>array('index','view','get','admin'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new Plan;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['Plan']))
		{
			$model->attributes=$_POST['Plan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Find list of results based on parameters
	 */
	public function actionGet()
	{
	    parent::actionGet();
		header("Access-Control-Allow-Origin: *");
		$model=Plan::model();
		$id=Yii::app()->getRequest()->getQuery('id');
		$state=Yii::app()->getRequest()->getQuery('state');
		$formulary_id=Yii::app()->getRequest()->getQuery('formulary_id');//this is what CMS uses to id cms plan
		$contract_name=Yii::app()->getRequest()->getQuery('contract_name');
		$p=array();
		$limit = 20;
		$conditions=array('order'=>'contract_name asc', 'limit' => $limit);
        $attrs = []; //list of attributes to search

		if(!empty($id))
		{
			$p['id']=$id;
		};
		if(!empty($state))
		{
			$p['state']=$state;
		};
		if(!empty($formulary_id))
		{
			$p['formulary_id']=$formulary_id;
		};
		if(!empty($contract_name))
		{
//			$p['contract_name']='contract_name';
			$conditions["condition"] = " contract_name like '%" . $contract_name . "%'";
		};
		if (!isset($p['limit'])){
			$conditions['limit'] = 20;
		}

		$data=$model->findAllByAttributes($attrs,$conditions);
		$listOfPlans=array();
		$attributesToExport = array();
		$attributesToExport = ["id","formulary_id", "contract_name","plan_name","state"];

		if(sizeof($p)==0)
		{
			foreach ($data as $d)
			{
				array_push($listOfPlans,$d->getAttributes($attributesToExport));
			}
		} else
		{
			foreach ($data as $d)
			{
				$dataArray=$d->getAttributes($attributesToExport);
				array_push($listOfPlans,$dataArray);
			}
		}
		if(sizeof($listOfPlans)==1)
		{
			$listOfPlans=$listOfPlans[0];
		}

		echo CJavaScript::jsonEncode($listOfPlans);
		Yii::app()->end();
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

		if(isset($_POST['Plan']))
		{
			$model->attributes=$_POST['Plan'];
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
		if(Yii::app()->request->isPostRequest)
		{
// we only allow deletion via POST request
			$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Plan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Plan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Plan']))
			$model->attributes=$_GET['Plan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Plan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
