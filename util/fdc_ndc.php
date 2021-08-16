<?php
/*
 * Import FDC NDC from inp/product_***.txt into fda_ndc table
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dibi\Connection;

const DEBUG = true;
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


$inp = fopen(__DIR__ . '/inp/product_sample.txt', 'r');
if (! $inp) die('File not found');
$header = fgets($inp);
if (! $header) die("Cannot open file");

$cols = explode('	', $header);
$cols = array_map(function ($col) {
    return strtolower($col);
}, $cols);

//if (DEBUG) var_dump($cols);
if (sizeof($cols) !== 20) die('Number of cols not 20');
try {
    while ($row = fgets($inp)) {
//    if (DEBUG) var_dump($row);
        $vals = explode("\t", $row);
        if (DEBUG) var_dump($vals);
        if (sizeof($vals) !== 20) {
            echo 'Number of values not 20, exiting..';
            break;
        }
        $productid = $vals[0];
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
        $substancename = $vals[13];
        $active_numerator_strength = $vals[14];
        $active_ingred_unit = $vals[15];
        $pharm_classes = $vals[16];
        $deaschedule = $vals[17];
        $ndc_exclude_flag = $vals[18];
        $listing_record_certified_through = $vals[19];

        $new_ndc = compact('productid');

        $exist_ndc = $db->query("SELECT id FROM fda_ndc WHERE productid = %s", $productid);
        $exist_ndc = $exist_ndc->fetchSingle();
        if (empty($exist_ndc)){
            $db->insert('fda_ndc', $new_ndc);
        }
        var_dump($exist_ndc);

    }
} catch (\Dibi\Exception $e) {
    echo "Error: " . $e->getMessage();
}

fclose($inp);

