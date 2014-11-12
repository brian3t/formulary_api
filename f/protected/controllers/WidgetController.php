<?php

class WidgetController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	protected static  $RPC = "";

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
	 * TODO: own methods
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','admin'),
				'roles'=>array('admin'),
			),
			array('allow',
				'actions'=>array('create'),
				'roles'=>array(''),
			),
			array('allow',
				'actions'=>array('view','report'),
				'roles'=>array('publisher'),
			),
			array('allow',
				'actions'=>array('viewown'),
				'roles'=>array('publisher'),
			),
			array('allow',
				'actions'=>array('update'),
				'roles'=>array('publisher'),
			),
			array('allow',
				'actions'=>array('delete'),
				'roles'=>array('publisher'),
			),
//			array('deny', // deny all users of deleting other account, index
//				'actions'=>array('index'),
//				'users'=>array('*'),
//			),
			array('deny', // deny all users of deleting other account, index
				'actions'=>array('admin'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Report view.
	 */
	public function actionReport()
	{
		$model=new Widget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Widget']))
			$model->attributes=$_GET['Widget'];

		$this->render('report',array(
			'model'=>$model,
		));
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
		$model=new Widget;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Widget']))
		{
			$model->attributes=$_POST['Widget'];
			if($model->save()){
//todo set ids
				$id = $model->id;
				$pubId = $model->getAttribute('publisher_id');
				$instCode = "";
				$instCode = '<div id="ian'.$id.'"></div>
<script type="text/javascript">
    (function() {
        var params =
        {
            w: "'. $id .'",
            dopt: "'. $model->getAttribute('display_options') .'",
            cb: (new Date()).getTime()
        };

        var qs="";
        for(var key in params){qs+="/"+key+"/"+params[key]}
        var s = document.createElement("script");
        s.type= \'text/javascript\';
        s.src = "'. 'http://formulary'. '/ce/ad/getAds" + qs;
        s.async = true;
        document.getElementById("ian'.$id.'").appendChild(s);
    })();
</script>';
				//todo replace engineye.com with baseurl
//			$this->installation_code = $instCode;
				$model->setAttribute('installation_code', $instCode);

				$model->save();

				$this->redirect(array('view','id'=>$model->id));
			}
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

		if(isset($_POST['Widget']))
		{
			$model->attributes=$_POST['Widget'];
			if($model->save())
				//generate widget installation code
//				<div id="contentad14408"></div>
//<script type="text/javascript">
//			(function() {
//				var params =
//        {
//			id: "fa5c0617-40c2-440e-ba45-8591784a173b",
//            d:  "Ym9yZWJ1cm4uY29t",
//            wid: "14408",
//            cb: (new Date()).getTime()
//        };
//
//        var qs="";
//        for(var key in params){qs+=key+"="+params[key]+"&"}
//        qs=qs.substring(0,qs.length-1);
//        var s = document.createElement("script");
//        s.type= 'text/javascript';
//        s.src = "http://api.content.ad/Scripts/widget.aspx?" + qs;
//        s.async = true;
//        document.getElementById("contentad14408").appendChild(s);
//    })();
//</script>

			$pubId = $model->getAttribute('publisher_id');
			$instCode = "";
			$instCode = '<div id="ian'.$id.'"></div>
<script type="text/javascript">
    (function() {
        var params =
        {
            w: "'. $id .'",
            dopt: "'. $model->getAttribute('display_options') .'",
            cb: (new Date()).getTime()
        };

        var qs="";
        for(var key in params){qs+="/"+key+"/"+params[key]}
        var s = document.createElement("script");
        s.type= \'text/javascript\';
        s.src = "'. 'http://formulary'. '/ce/ad/getAds" + qs;
        s.async = true;
        document.getElementById("ian'.$id.'").appendChild(s);
    })();
</script>';
			//todo replace engineye.com with baseurl
//			$this->installation_code = $instCode;
			$model->setAttribute('installation_code', $instCode);
			$model->save();
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
		//todo publishers, only view your own widgets!!
		$dataProvider=new CActiveDataProvider('Widget');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Widget('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Widget']))
			$model->attributes=$_GET['Widget'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Widget the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Widget::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Widget $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='widget-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	//count revenue, also count rpc
	public function countRevenue($id)
	{
		$model=Widget::model()->findByPk($id);
		if($model===null)
			return 0;
		$rev = 0;
		$txns = Txn::model()->findAllByAttributes(array('widget_id'=>$id));
		foreach ($txns as $txn)
		{
			$rev += $txn->cpc;
		}
		if (sizeof($txns) > 0){
			self::$RPC = "$". $rev/sizeof($txns);
		}
		else{
			self::$RPC = "N/A";
		}
		return $rev;

	}
	public function countRpc($id){
			self::countRevenue($id);
		return self::$RPC;
	}

}
