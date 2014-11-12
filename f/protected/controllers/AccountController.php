<?php

class AccountController extends Controller
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
				'actions'=>array('view'),
				'roles'=>array('admin'),
			),
			array('allow',
				'actions'=>array('create'),
				'roles'=>array(''),
			),
			array('allow',
				'actions'=>array('view'),
				'roles'=>array('publisher, advertiser'),
			),
			array('allow',
				'actions'=>array('viewown'),
				'roles'=>array('publisher, advertiser'),
			),
			array('allow',
				'actions'=>array('update'),
				'roles'=>array('publisher, advertiser'),
			),
			array('allow',
				'actions'=>array('delete'),
				'roles'=>array('publisher, advertiser'),
			),
			array('deny', // deny all users of deleting other account, index
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('deny', // deny all users of deleting other account, index
				'actions'=>array('admin'),
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
		$id=yii::app()->getUser()->getId();
		$record=User::model()->findByAttributes(array('id'=>$id));
		$account_id=$record->account_id;
		if(app()->user->roles !== "admin" && $account_id!==$id)
		{
			$this->redirect(array('index'));
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else
		{
//			echo 'An user is created, please check your email ' . $user_email . ' for the login credential';
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewown()
	{
		$id=yii::app()->getUser()->getId();
		$record=User::model()->findByAttributes(array('id'=>$id));
		if($record===null){
//			$this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->redirect(app()->getBaseUrl());
		}
		else
		{
			$account_id=$record->account_id;

			$this->render('view',array(
				'model'=>$this->loadModel($account_id),

			));
		}
	}

	public function generateRandomString($length=10)
	{
		$characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString='';
		for ($i=0;$i < $length;$i++)
		{
			$randomString.=$characters[rand(0,strlen($characters) - 1)];
		}
		return $randomString;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
//			xdebug_break();
			//check if user_email already existed
			$user_email=$_POST['user_email'];
			$userEmails = Yii::app()->db->createCommand()
				->select('email')
				->from('user')
				->queryAll();
			$found = false;
			$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($userEmails));
			foreach ($it as $value){
				if ($value === $user_email){
					$found = true;
				}
			}
			xdebug_break();
			if ($found){
				//todo redirect to create page
				$this->redirect(Yii::app()->baseUrl.'/index.php?r=account/create&error_msg='."User email is already in use! Please try again.");
			}

			if($model->save())
			{
				//create user and link with account - account_id
				$user=new User;
				$user->username=$model->name;
				$user->email=$user_email;
				$user->password=$this->generateRandomString();
				$user->account_id=$model->id;
				if($model->isAdvertiser)
				{
					$user->roles='advertiser';
				}
				if($model->isPublisher)
				{
					if($user->roles!=="")
					{
						$user->roles.=",";
					}
					$user->roles.='publisher';
				}
				$user->save();
				mb_send_mail($user_email,'Account created','Welcome to Formulary! Your account has been created. <br/> User name: '. $user->username . ' password: '. $user->password, 'Content-Type: text/html');
				$this->redirect(Yii::app()->baseUrl. '/index.php?r=site/page&view=account_created&user_email='. $user_email);
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
		$userId=yii::app()->getUser()->getId();
		$record=User::model()->findByAttributes(array('id'=>$userId));
		$account_id=$record->account_id;
		if($account_id!==$id)
		{
			$this->redirect(array('index'));
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdateOwn($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
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

		$id=yii::app()->getUser()->getId();
		$record=User::model()->findByAttributes(array('id'=>$id));
		$account_id=$record->account_id;
		if($account_id!==$id)
		{
			$this->redirect(array('index'));
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else
		{

			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteOwn($id)
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
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];
		//TODO REGISTER DATA TABLE FILTER
		if (app()->request->getQuery("ajax","") == "account-grid"){
			echo '<script>alert("here");</script>';
		}
		$this->render('admin',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
