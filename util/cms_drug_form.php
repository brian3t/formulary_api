<?php
/*
 * Import CMS' basic_drugs_formulary from inp/basic_drugs_formulary_file***.txt into fda_ndc table
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dibi\Connection;

const DEBUG = false;
//const DEBUG = true;
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


//$inp = fopen(__DIR__ . '/inp/basic drugs formulary file sample 20210731.txt', 'r');
$inp = fopen(__DIR__ . '/inp/basic drugs formulary file  20210731_fullfile.txt', 'r');
$populate_msg = '';
if (! $inp) die('File not found');
$header = fgets($inp);
if (! $header) die("Cannot open file");

$cols = explode('|', $header);
$cols = array_map(function ($col) {
    return strtolower($col);
}, $cols);

//if (DEBUG) var_dump($cols);
if (sizeof($cols) !== NUM_COLS) die("Number of cols not " . NUM_COLS);
try {
    $cnt_inserted = 0;
    while ($row = fgets($inp)) {
        if (DEBUG) var_dump($row);
        $row = str_replace("\r", '', $row);
        $row = str_replace("\n", '', $row);
        $vals = explode("|", $row);
        if (DEBUG) var_dump($vals);
        if (sizeof($vals) !== NUM_COLS) {
            echo 'Number of values not ' . NUM_COLS . ', exiting..';
            break;
        }
        $formulary_id = $vals[0];
        $formulary_version = $vals[1];
        $contract_year = $vals[2];
        $rxcui = $vals[3];
        $orig_ndc = $vals[4];//00002223680
        //convert 11 digits ndc to 8 digits ndc by FDA
        if ($orig_ndc[0] === '0')
        {
            $ndc = substr($orig_ndc, 1, 4) . '-' . substr($orig_ndc, 5, 4);//00002223680 -> 0002-2236
        } else {
            $ndc = substr($orig_ndc, 0, 5) . '-' . substr($orig_ndc, 6, 3);//49938011001 -> 49938-110
        }
        $tier_level_value = $vals[5];
        $quantity_limit_yn = $vals[6];
        $quantity_limit_amount = $vals[7];
        $quantity_limit_days = $vals[8];
        $prior_authorization_yn = $vals[9];
        $step_therapy_yn = $vals[10];

        $formulary_version = intval($formulary_version);
        $contract_year = intval($contract_year);
        $rxcui = intval($rxcui);
        $tier_level_value = intval($tier_level_value);
        $quantity_limit_amount = intval($quantity_limit_amount);
        $quantity_limit_days = intval($quantity_limit_days);


        // If it's not already UTF-8, convert to it
//        if (mb_detect_encoding($labelername, 'utf-8', true) === false) {
//            $labelername = mb_convert_encoding($labelername, 'utf-8', 'iso-8859-1');
//        }


        $new_cms_drug_form = [];
        $csv_list_of_var_names = 'formulary_id,formulary_version,contract_year,rxcui,ndc,tier_level_value,quantity_limit_yn,quantity_limit_amount,quantity_limit_days
        ,prior_authorization_yn,step_therapy_yn';
        $csv_list_of_var_names = str_replace(' ', '', $csv_list_of_var_names);
        $csv_list_of_var_names = str_replace("\n", '', $csv_list_of_var_names);
        $csv_list_of_var_names = explode(',', $csv_list_of_var_names);
        foreach ($csv_list_of_var_names as $var_name) {
            $value = $$var_name;
            if (strtolower($value) == 'y') $value = false;
            if (strtolower($value) == 'n') $value = true;
            $new_cms_drug_form[$var_name] = $value;
        }


        $exist_cms_drug_form = $db->query("SELECT id FROM cms_drug_form WHERE formulary_id = %s
AND formulary_version = %s AND contract_year = %s AND rxcui = %s
", $formulary_id, $formulary_version, $contract_year, $rxcui);
        $exist_cms_drug_form = $exist_cms_drug_form->fetchSingle();
        if (! empty($exist_cms_drug_form)) continue;

        $insert_res = $db->query('INSERT INTO cms_drug_form', $new_cms_drug_form);
        if ($insert_res instanceof Dibi\Result) {
            if ($insert_res->count() !== 1) {
                $populate_msg .= ". Warning: cms_drug_form not saved";
            }
            $new_id = $db->getInsertId() ?? null;
            if (is_int($new_id)) $cnt_inserted++;
        }
        if (DEBUG) var_dump($insert_res);
    }
} catch (\Dibi\Exception $e) {
    echo PHP_EOL . "Error: " . $e->getMessage() . " New NDC: " . json_encode($new_cms_drug_form);
}
echo PHP_EOL . "Inserted $cnt_inserted records";

fclose($inp);
echo $populate_msg;

