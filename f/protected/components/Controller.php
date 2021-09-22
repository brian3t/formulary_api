<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function actionGet()
    {
        include_once(dirname(__DIR__) . '/config/override.php');

        $yii_conf = YII_CONF;
        $yii_conf = $yii_conf['components']['db'];
        $conn_str = $yii_conf['connectionString'];//mysql:host=localhost;dbname=formulary
        $conn_str = preg_replace('/(^.+host=)/i', '', $conn_str);
        $db_host = preg_replace('/(;.+)$/i', '', $conn_str);
        $db_name = preg_replace('/(.+dbname=)/i', '', $conn_str);

        $db_conf = ['driver' => 'mysqli', 'host' => $db_host, 'username' => $yii_conf['username'], 'password' => $yii_conf['password'], 'database' => $db_name
        ]; //['driver' => 'mysqli', 'host' => $hostname, 'username' => $db_username, 'password' => $db_password, 'database' => 'dbname']
        $remote_addr = $_SERVER['REMOTE_ADDR'] | '';
        $agent = $_SERVER['HTTP_USER_AGENT'] | '';

        mysqli_report(MYSQLI_REPORT_ALL);
        $mysqli = new mysqli($db_host, $db_conf['username'], $db_conf['password'], $db_conf['database']);
        $sql = "INSERT INTO `usage` (ip, agent) VALUES (?,?)";
        if (! ($stmt = $mysqli->prepare($sql))) {
            return;
        }
        /* bind parameters for markers */
        $stmt->bind_param("ss", $remote_addr, $agent);
        /* execute query */
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }
}
