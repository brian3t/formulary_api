<?php
/*
 * Import CMS' basic_drugs_formulary from inp/basic_drugs_formulary_file***.txt into fda_ndc table
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dibi\Connection;

//const DEBUG = false;
const DEBUG = true;
const NUM_COLS = 11;

$yii_conf = require_once(dirname(__DIR__) . '/f/protected/config/override.php');
$yii_conf = $yii_conf['components']['db'];
$conn_str = $yii_conf['connectionString'];//mysql:host=localhost;dbname=formulary
$conn_str = preg_replace('/(^.+host=)/i', '', $conn_str);
$db_host = preg_replace('/(;.+)$/i', '', $conn_str);
$db_name = preg_replace('/(.+dbname=)/i', '', $conn_str);

$db_conf = ['driver' => 'mysqli', 'host' => $db_host, 'username' => $yii_conf['username'], 'password' => $yii_conf['password'], 'database' => $db_name
]; //['driver' => 'mysqli', 'host' => $hostname, 'username' => $db_username, 'password' => $db_password, 'database' => 'dbname']
try {
    $db = new Connection($db_conf);
} catch (Exception $exception) {
    echo "Error connecting " . $exception->getMessage();
    return;
}


$inp = fopen(__DIR__ . '/inp/basic drugs formulary file sample 20210731.txt', 'r');
$populate_msg = '';
if (! $inp) die('File not found');
$header = fgets($inp);
if (! $header) die("Cannot open file");

$cols = explode('	', $header);
$cols = array_map(function ($col) {
    return strtolower($col);
}, $cols);

//if (DEBUG) var_dump($cols);
if (sizeof($cols) !== NUM_COLS) die("Number of cols not " . NUM_COLS);
try {
    while ($row = fgets($inp)) {
    if (DEBUG) var_dump($row);
        $row = str_replace("\r", '', $row);
        $row = str_replace("\n", '', $row);
        $vals = explode("\t", $row);
        if (DEBUG) var_dump($vals);
        if (sizeof($vals) !== NUM_COLS) {
            echo 'Number of values not ' . NUM_COLS . ', exiting..';
            break;
        }
        $formulary_id = $vals[0];
        $productndc = $vals[1];
        $producttypename = $vals[2];
        $proprietaryname = $vals[3];
        $proprietarynamesuffix = $vals[4];
        $nonproprietaryname = $vals[5];
        $dosageformname = $vals[6];
        $routename = $vals[7];
        $startmarketingdate = $vals[8];
        $endmarketingdate = $vals[9];
        $marketingcategoryname = $vals[10];
        $applicationnumber = $vals[11];
        $labelername = $vals[12];

        // If it's not already UTF-8, convert to it
        if (mb_detect_encoding($labelername, 'utf-8', true) === false) {
//            echo "labelername not utf8, labelername: $labelername";
            $labelername = mb_convert_encoding($labelername, 'utf-8', 'iso-8859-1');
        }

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
        $csv_list_of_var_names = str_replace("\n", '', $csv_list_of_var_names);
        $csv_list_of_var_names = explode(',', $csv_list_of_var_names);
        foreach ($csv_list_of_var_names as $var_name) {
            $value = $$var_name;
            $new_ndc[$var_name] = $value;
        }


        $exist_ndc = $db->query("SELECT id FROM fda_ndc WHERE productid = %s", $productid);
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
    echo PHP_EOL. "Error: " . $e->getMessage(). " New NDC: " . json_encode($new_ndc);
}

fclose($inp);
echo $populate_msg;

