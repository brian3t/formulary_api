<?php

class AdController extends Controller
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
                'actions'=>array('index'),
                'roles'=>array('advertiser'),
            ),
            array('allow',
                'actions'=>array('view'),
                'roles'=>array('advertiser'),
            ),
            array('allow',
                'actions'=>array('create'),
                'roles'=>array('advertiser'),
            ),
            array('allow',
                'actions'=>array('update'),
                'roles'=>array('advertiser'),
            ),
			array('allow',
				'actions'=>array('delete'),
				'roles'=>array('advertiser'),
			),
			array('allow',
				'actions'=>array('report'),
				'roles'=>array('advertiser'),
			),
			array('allow',
				'actions'=>array('getAds','get'),
				'roles'=>array('*')),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			)
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
		$model=new Ad;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ad']))
		{
			$model->attributes=$_POST['Ad'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Ad']))
		{
			$model->attributes=$_POST['Ad'];
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
		$dataProvider=new CActiveDataProvider('Ad');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	protected function genScriptToTrackTxn($aid, $w){
		$s = "";
		$s ="var hrx= new XMLHttpRequest();hrx.open('GET', '//brax.io/ce/txn/track/a/" . $aid . "/w/" . $w. "', true);hrx.send(null);";
		return $s;
	}


	//$w: widget id
	public function actionGetAds($w){
		header("Content-type: text/javascript");
		$this->layout=false;

		$p = array();
//		$criteria->index = "id";
		$conditions = array('order' => 'id desc');
		$testQuery = Ad::model()->findAllByAttributes($p,$conditions);
		$allName = array();
		$a = $testQuery[0];
		array_push($allName,$a->title);
		array_push($allName,$a->description);
//		array_push($allName,'<img src=\"//iadly.com/ce/imp/pixel/a/' . $a->id . '/w/' . $w .'\"/>');
		array_push($allName,'<img src=\"' . $a->image_url .'\" alt=\"'. $a->title .'\"/>');
//		array_push($allName,self::genScriptToTrackTxn());

//		header('Content-type: application/json');
//		echo json_encode($this->loadModel($id));
//		echo implode('<br/>',$allName);
		echo 'var htmlText = "'. CHtml::encode('<img src=\"//iadly.com/ce/imp/pixel/a/' . $a->id . '/w/' . $w .'\"/><a target=\"_blank\" onclick=\"'. self::genScriptToTrackTxn($a->id,$w) .'\" href=\"'. $a->dest_url . '\">' . $allName[0] .$allName[1] . $allName[2] . '</a>') . '";';
		echo 'document.getElementById(document.querySelector(\'[id="ian'.$w.'"]\').id).innerHTML=htmlText.replace(/&amp;/g,\'&\').replace(/&quot;/gi,\'"\').replace(/&lt;/gi,\'<\').replace(/&gt;/gi,\'>\').replace(/&apos;/gi,\'\\\'\');';
		Yii::app()->end();

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ad('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ad']))
			$model->attributes=$_GET['Ad'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Report view.
	 */
	public function actionReport()
	{
		$model=new Ad('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ad']))
			$model->attributes=$_GET['Ad'];

		$this->render('report',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ad the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ad::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ad $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ad-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
