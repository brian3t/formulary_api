<?php
//$basePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
//echo $basePath;
require_once(dirname(__FILE__) . "/../vendor/autoload.php");
// Load test target classes
spl_autoload_register(function ($c) {
    @include_once strtr($c, '\\_', '//') . '.php';
});
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../Source');

use GuzzleHttp\Exception\GuzzleException;
use Masterminds\HTML5;

class CmsFormController extends Controller
{
    /**
     * CMS Formulary controller
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
                'actions' => array('index', 'view', 'get', 'admin'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Find list of results based on parameters
     */
    public function actionGet() {
        header("Access-Control-Allow-Origin: *");
        $model = CmsForm::model();
        $id = Yii::app()->getRequest()->getQuery('id');
        $formulary_id = Yii::app()->getRequest()->getQuery('formulary_id');
        $ndc = Yii::app()->getRequest()->getQuery('ndc');
        $tier_level_value = Yii::app()->getRequest()->getQuery('tier_level_value');
        $p = array();
        $conditions = array();
//		$conditions=array('limit'=>'name asc');
        $result = array();

        if (! empty($id)) {
            $p['id'] = $id;
        }
        if (! empty($f_id)) {
            $p['formulary_id'] = $formulary_id;
        }
        if (! empty($ndc)) {
            $p['ndc'] = $ndc;
        }
        if (! empty($tier_level_value)) {
            $p['tier_level_value'] = $tier_level_value;
        }

        $countResults = intval($model->countByAttributes($p, $conditions));
        if ($countResults != 1) {
            if ($countResults > 1) {
                $result["status"] = -1;
                $result["message"] = "Multiple result found!";
                app()->end();
            } else {
                //need either drugName or drugID
                if (empty($ndc)) {
                    $result['status'] = -1;
                    $result['message'] = "Missing ndc";
                }
                /*if (empty($drugName)) {
                    $drugName = Drug::model()->findByPk($drug_id)->name;
                    if (empty($drugName)) {
                        $result['status'] = -1;
                        $result['message'] = "Can not look up drug name using drug Id";
                    }
                }*/
                $planName = Plan::model()->findByAttributes(array_intersect_key($p, array(
                    "formulary_id" => null,
                )))->name;
                if ($planName == null) {
                    $result['status'] = -1;
                    $result['message'] = "Can not find plan in database";
                    app()->end();
                }
                $queries = array(
                    'ndc' => $ndc,
                    'formulary_id' => $formulary_id
                );
                $listOfFormulary['id'] = "-1";
                $listOfFormulary['tier_code'] = "N/A";
                $listOfFormulary['additional_info'] = "Information not available at this moment. Please check back later";
                $listOfFormulary['restriction_code'] = "N/A";
                echo CJavaScript::jsonEncode($listOfFormulary);
                Yii::app()->end();
            }
        }

        //else, CountResult == 1
        $data = $model->findByAttributes($p, $conditions);
        $listOfFormulary = array_intersect_key(($data != null ? $data->getAttributes() : []), array("id" => null,
            "formulary_id" => null,
            "ndc" => null,
            "tier_level_value" => null,
            "quantity_limit_yn" => null,
            "quantity_limit_amount" => null,
            "quantity_limit_days" => null,
        ));

        echo CJavaScript::jsonEncode($listOfFormulary);
        Yii::app()->end();
    }


    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CmsForm;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['CmsForm'])) {
            $model->attributes = $_POST['CmsForm'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['CmsForm'])) {
            $model->attributes = $_POST['CmsForm'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
            $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (! isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CmsForm');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CmsForm('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CmsForm'])) {
            $model->attributes = $_GET['CmsForm'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = CmsForm::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
