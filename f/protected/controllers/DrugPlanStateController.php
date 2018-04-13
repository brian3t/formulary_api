<?php
//$basePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
//echo $basePath;
require_once( dirname( __FILE__ ) . "/../vendor/autoload.php" );
// Load test target classes
spl_autoload_register( function ( $c ) {
	@include_once strtr( $c,'\\_','//' ) . '.php';
} );
set_include_path( get_include_path() . PATH_SEPARATOR . __DIR__ . '/../Source' );

use Masterminds\HTML5;

class DrugPlanStateController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array( 'index','view','get','admin' ),
				'users'   => array( '*' ),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array( 'create','update' ),
				'users'   => array( '@' ),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array( 'admin','delete' ),
				'users'   => array( 'admin' ),
			),
			array(
				'deny',  // deny all users
				'users' => array( '*' ),
			),
		);
	}

	/**
	 * Find list of results based on parameters
	 */
	public function actionGet() {
		header( "Access-Control-Allow-Origin: *" );
		$model      = DrugPlanState::model();
		$id         = Yii::app()->getRequest()->getQuery( 'id' );
		$f_id       = Yii::app()->getRequest()->getQuery( 'f_id' );
		$drug_id    = Yii::app()->getRequest()->getQuery( 'drug_id' );
		$drugName   = Yii::app()->getRequest()->getQuery( 'drug_name' );
		$state      = Yii::app()->getRequest()->getQuery( 'state' );
		$p          = array();
		$conditions = array();
//		$conditions=array('limit'=>'name asc');
		$result = array();

		if ( ! empty( $id ) ) {
			$p['id'] = $id;
		}
		if ( ! empty( $f_id ) ) {
			$p['f_id'] = $f_id;
		}
		if ( ! empty( $drug_id ) ) {
			$p['drug_id'] = $drug_id;
		}
		if ( ! empty( $drugName ) ) {
			$p['drug_name_param'] = str_replace( " ","",$drugName );
		}
		if ( ! empty( $state ) ) {
			$p['state_code'] = $state;
		}

		$countResults = intval( $model->countByAttributes( $p,$conditions ) );
		if ( $countResults != 1 ) {
			if ( $countResults > 1 ) {
				$result["status"]  = - 1;
				$result["message"] = "Multiple result found!";
				app()->end();
			} else {
				//need either drugName or drugID
				if ( empty( $drugName ) && empty( $drug_id ) ) {
					$result['status']  = - 1;
					$result['message'] = "Missing either drug name or drug id";
				}
				if ( empty( $drugName ) ) {
					$drugName = Drug::model()->findByPk( $drug_id )->name;
					if ( empty( $drugName ) ) {
						$result['status']  = - 1;
						$result['message'] = "Can not look up drug name using drug Id";
					}
				}
				$planName = Plan::model()->findByAttributes( array_intersect_key( $p,array(
					"f_id" => null,
					"state_code"
				) ) )->name;
				if ( $planName == null ) {
					$result['status']  = - 1;
					$result['message'] = "Can not find plan in database";
					app()->end();
				}
				$queries         = array(
					'planName' => $planName,
					'planID'   => $f_id
				);
				$drug_name_param = preg_replace('/[^\da-z]/i', '', $drugName);
				$url             = "http://lookup.decisionresourcesgroup.com/drugs/" . $drug_name_param . "/" . $state . "/plans?" . http_build_query( $queries ); //http://www.fingertipformulary.com/drugs/Flomax/CA/plans?planName=Express+Scripts+High+Performance&planID=356
				$headers = get_headers($url);
				if(!in_array(substr($headers[0], 9, 3), ["404","400","500","403","404"])){//todob here proper check for headers, because we have 302, then 301, then 403 all in 1 request. Might use guzzle here
					$html            = file_get_contents( $url );
				}else{
					$listOfFormulary['id']               = "-1";
					$listOfFormulary['tier_code']        = "N/A";
					$listOfFormulary['additional_info']   = "Information not available at this moment. Please check back later";
					$listOfFormulary['restriction_code'] = "N/A";
					echo CJavaScript::jsonEncode( $listOfFormulary );
					Yii::log("404 at" . $url, CLogger::LEVEL_INFO, 'scraper');
					Yii::app()->end();
				}
				$html5           = new HTML5();
				$dom             = $html5->loadHTML( $html );
				$error           = qp( $dom,'div#content h1:nth-child(1):contains(An error occurred)' );
				if ( strlen($error->text()) > 0 ) {
					$listOfFormulary['id']               = "-1";
					$listOfFormulary['tier_code']        = "N/A";
					$listOfFormulary['additional_info']   = "Information not available at this moment. Please check back later";
					$listOfFormulary['restriction_code'] = "N/A";
					echo CJavaScript::jsonEncode( $listOfFormulary );
					Yii::log(qp($dom,'div#main>p:contains(Error message)')->text(),CLogger::LEVEL_INFO,'scraper');
					Yii::app()->end();
				} else {
					$h    = qp( $dom,'ul#results' );
					$tier = "N/A";
					if ( sizeof(qp( $h,'li:contains(Tier:)>a' )->attr('href')) > 0) {
						$tier = qp( $h,'li:contains(Tier:)>a' )->attr('href');
					};
					$tier = array_pop(explode("=", $tier));
					$tier_code = ( sizeof( $tier) > 0 ? str_replace("tier", "", $tier) : "-1" );
					if ( $tier_code == "8" ) {
						$tier_code = "N/A";
					}


					$additionalInfo = qp( $h,"li:contains(Additional Info:)" );
					qp( $additionalInfo,"strong" )->remove();
					$additional_info = trim( preg_replace( '/[\t\n]/',"",$additionalInfo->text() ) );

					$restrictions = qp( $h,"li:contains(Restrictions:)" );
					qp( $restrictions,"strong" )->remove();
					$restriction_code = trim( preg_replace( '/[\t\n]/',"",$restrictions->text() ) );
					if ( $restriction_code == "None" ) {
						$restriction_code = "";
					};
					//write to SQL
					if ( empty( $drug_id ) ) {
						$drug_id = Drug::model()->findByAttributes( array( "name_param" => $drugName ) )->id;
						if ( $drug_id == null ) {
							$drug_id = - 1;
						}
					}
					$state_code = $state;
					$newModel   = new DrugPlanState;
					$newModel->setAttributes( compact( "f_id","drug_id","state_code","drug_name_param","tier_code","additional_info","restriction_code" ) );
					if ( $newModel->validate() ) {
						try {
							$newModel->save();
						} catch ( Exception $e ) {
								$listOfFormulary['id']               = "-1";
								$listOfFormulary['tier_code']        = "N/A";
								$listOfFormulary['additional_info']   = "Information not available at this moment. Please check back later";
								$listOfFormulary['restriction_code'] = "N/A";
								echo CJavaScript::jsonEncode( $listOfFormulary );
								Yii::log( $e,CLogger::LEVEL_ERROR );
								Yii::app()->end();
						}
					}
				};
			}

		}

		//else, CountResult == 1
		$data            = $model->findByAttributes( $p,$conditions );
		$listOfFormulary = array_intersect_key( $data->getAttributes(),array( "id"               => null,
		                                                                      "tier_code"        => null,
		                                                                      "additional_info"  => null,
		                                                                      "restriction_code" => null
			) );

		echo CJavaScript::jsonEncode( $listOfFormulary );
		Yii::app()->end();
	}


	/**
	 * Displays a particular model.
	 *
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView( $id ) {
		$this->render( 'view',array(
			'model' => $this->loadModel( $id ),
		) );
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new DrugPlanState;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if ( isset( $_POST['DrugPlanState'] ) ) {
			$model->attributes = $_POST['DrugPlanState'];
			if ( $model->save() ) {
				$this->redirect( array( 'view','id' => $model->id ) );
			}
		}

		$this->render( 'create',array(
			'model' => $model,
		) );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate( $id ) {
		$model = $this->loadModel( $id );

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if ( isset( $_POST['DrugPlanState'] ) ) {
			$model->attributes = $_POST['DrugPlanState'];
			if ( $model->save() ) {
				$this->redirect( array( 'view','id' => $model->id ) );
			}
		}

		$this->render( 'update',array(
			'model' => $model,
		) );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete( $id ) {
		if ( Yii::app()->request->isPostRequest ) {
// we only allow deletion via POST request
			$this->loadModel( $id )->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if ( ! isset( $_GET['ajax'] ) ) {
				$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'admin' ) );
			}
		} else {
			throw new CHttpException( 400,'Invalid request. Please do not repeat this request again.' );
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider( 'DrugPlanState' );
		$this->render( 'index',array(
			'dataProvider' => $dataProvider,
		) );
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new DrugPlanState( 'search' );
		$model->unsetAttributes();  // clear any default values
		if ( isset( $_GET['DrugPlanState'] ) ) {
			$model->attributes = $_GET['DrugPlanState'];
		}

		$this->render( 'admin',array(
			'model' => $model,
		) );
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id ) {
		$model = DrugPlanState::model()->findByPk( $id );
		if ( $model === null ) {
			throw new CHttpException( 404,'The requested page does not exist.' );
		}

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation( $model ) {
		if ( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'drug-plan-state-form' ) {
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
	}
}
