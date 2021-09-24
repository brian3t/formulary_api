<?php
/*
 * Group RXNCONSO table into rxconso_sing
 * Keep only one TTY from rxnconso
 *
 */
require_once 'rb.php';
//const DEBUG = false;
const DEBUG = true;
if (DEBUG) $LIMIT = 5; else $LIMIT = PHP_INT_MAX;

$yii_conf = require_once(dirname(__DIR__) . '/f/protected/config/override.php');
$yii_conf = $yii_conf['components']['db'];
$conn_str = $yii_conf['connectionString'];//mysql:host=localhost;dbname=formulary
$conn_str = preg_replace('/(^.+host=)/i', '', $conn_str);
$db_host = preg_replace('/(;.+)$/i', '', $conn_str);
$db_name = preg_replace('/(.+dbname=)/i', '', $conn_str);

$db_conf = ['driver' => 'mysqli', 'host' => $db_host, 'username' => $yii_conf['username'], 'password' => $yii_conf['password'], 'database' => $db_name
]; //['driver' => 'mysqli', 'host' => $hostname, 'username' => $db_username, 'password' => $db_password, 'database' => 'dbname']
try {
    R::setup("mysql:host=$db_host;dbname=$db_name", $db_conf['username'], $db_conf['password']);
} catch (Exception $exception) {
    echo "Error connecting " . $exception->getMessage();
    return;
}
//for version 5.3 and higher
//optional but recommended
R::useFeatureSet('novice/latest');

$post = R::dispense('post');
$post->text = 'Hello World';

//create or update
$id = R::store($post);

//retrieve
$post = R::load('post', $id);

//delete
//R::trash( $post );

$populate_msg = '';
$rxcuis = R::getAll("SELECT DISTINCT(rxcui) FROM RXNCONSO" . (DEBUG ? " LIMIT $LIMIT " : ''));

//if (DEBUG) var_dump($cols);
try {
    foreach ($rxcuis as ['rxcui' => $rxcui]) {
//    if (DEBUG) var_dump($row);
        R::hunt('rxnconso_sing', "rxcui = :rxcui", ['rxcui' => $rxcui]);

        $longest_tty = R::find("RXNCONSO", "RXCUI = :rxcui ORDER BY STR LIMIT 1", ['rxcui' => $rxcui]);
        //todo here longest_tty is a bean
        if (! is_array($longest_tty) || count($longest_tty) != 1) continue;
        $longest_tty = $longest_tty[0];

        continue;

        $vals = $longest_tty;
        $substancename = $vals[13];
        $active_numerator_strength = $vals[14];
        $active_ingred_unit = $vals[15];
        $pharm_classes = $vals[16];
        $deaschedule = $vals[17];
        $ndc_exclude_flag = $vals[18];
        $listing_record_certified_through = $vals[19];

        $new_ndc = [];
        $csv_list_of_var_names = 'productid,productndc,producttypename,proprietaryname,proprietarynamesuffix,nonproprietaryname,dosageformname,routename
        ,startmarketingdate,endmarketingdate,marketingcategoryname,applicationnumber,labelername,substancename,active_numerator_strength,active_ingred_unit
        ,pharm_classes,deaschedule,ndc_exclude_flag,listing_record_certified_through';
        $csv_list_of_var_names = str_replace(' ', '', $csv_list_of_var_names);
        $csv_list_of_var_names = str_replace(");\n", '', $csv_list_of_var_names);
        $csv_list_of_var_names = explode(',', $csv_list_of_var_names);
        foreach ($csv_list_of_var_names as $var_name) {
            $value = $$var_name;
            $new_ndc[$var_name] = $value;
        }


        $exist_ndc = $db->query("SELECT id FROM fda_ndc WHERE productid = %s", '$productid');
        $exist_ndc = $exist_ndc->fetchSingle();
        if (! empty($exist_ndc)) continue;

        $insert_res = $db->query('INSERT INTO fda_ndc', $new_ndc);
        if ($insert_res instanceof Dibi\Result) {
            if ($insert_res->count() !== 1) {
                $populate_msg .= ". Warning: ndc not saved";
            }
            $ndc_id = $db->getInsertId() ?? null;
        }
        if (DEBUG) var_dump($insert_res);
    }
} catch (\Dibi\Exception $e) {
    echo PHP_EOL . "Error: " . $e->getMessage() . " New NDC: " . json_encode($new_ndc);
}

echo $populate_msg;

