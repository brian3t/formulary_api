<?php
/*
 * Import CMS' plan_information from inp/plan_information***.txt into cplan_full table
 * After that, truncate cplan table
 * And populate into cplan table. Only save 1 plan_id per formulary (group by)
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dibi\Connection;

const DEBUG = false;
//const DEBUG = true;
const NUM_COLS = 15;

$yii_conf = require_once(dirname(__DIR__) . '/f/protected/config/override.php');
$yii_conf = $yii_conf['components']['db'];
$conn_str = $yii_conf['connectionString'];//mysql:host=localhost;dbname=formulary
$conn_str = preg_replace('/(^.+host=)/i', '', $conn_str);
$db_host = preg_replace('/(;.+)$/i', '', $conn_str);
$db_name = preg_replace('/(.+dbname=)/i', '', $conn_str);

$db_conf = ['driver' => 'mysqli', 'host' => $db_host, 'username' => $yii_conf['username'], 'password' => $yii_conf['password'], 'database' => $db_name];
try {
    $db = new Connection($db_conf);
} catch (Exception $exception) {
    echo "Error connecting " . $exception->getMessage();
    return;
}


$inp = fopen(__DIR__ . '/inp/plan information  20210731_fullfile.txt', 'r');
//$inp = fopen(__DIR__ . '/inp/basic drugs formulary file  20210731_fullfile.txt', 'r');
$populate_msg = '';
if (! $inp) die('File not found');
$header = fgets($inp);
//contract_id|plan_id|segment_id|contract_name                      |plan_name
//|formulary_id|premium|deductible|icl|ma_region_code|pdp_region_code|state|county_code|snp|plan_suppressed_yn
//H0022     |001    |000        |BUCKEYE COMMUNITY HEALTH PLAN, INC.|Buckeye Health Plan - MyCare Ohio (Medicare-Medicaid Plan)
//|00021467     |0.00   |0          |.|              |              |OH     |36110      |0|N
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
        $contract_id = $vals[0];
        $plan_id = $vals[1];
        $contract_name = $vals[3];
        $plan_name = $vals[4];
        $formulary_id = $vals[5];
        $state = $vals[11];
        $zip = $vals[12];
        $plan_suppressed_yn = $vals[14];

        // If it's not already UTF-8, convert to it
        if (mb_detect_encoding($plan_name, 'utf-8', true) === false) {
            $plan_name = mb_convert_encoding($plan_name, 'utf-8', 'iso-8859-1');
        }

        $new_cms_plan = [];
        $csv_list_of_var_names = 'contract_id,plan_id,contract_name,plan_name,formulary_id,state,zip,plan_suppressed_yn';
        $csv_list_of_var_names = str_replace(' ', '', $csv_list_of_var_names);
        $csv_list_of_var_names = str_replace("\n", '', $csv_list_of_var_names);
        $csv_list_of_var_names = explode(',', $csv_list_of_var_names);
        foreach ($csv_list_of_var_names as $var_name) {
            $value = $$var_name;
            if (strtolower($value) == 'y') $value = true;
            if (strtolower($value) == 'n') $value = false;
            $new_cms_plan[$var_name] = $value;
        }


        $exist_cms_plan = $db->query("SELECT id FROM cplan WHERE contract_id = %s AND plan_id = %s", $contract_id, $plan_id);
        $exist_cms_plan = $exist_cms_plan->fetchSingle();
        if (! empty($exist_cms_plan)) continue;

        $insert_res = $db->query('INSERT INTO cplan', $new_cms_plan);
        if ($insert_res instanceof Dibi\Result) {
            if ($insert_res->count() !== 1) {
                $populate_msg .= ". Warning: cplan not saved";
            }
            $new_id = $db->getInsertId() ?? null;
            if (is_int($new_id)) $cnt_inserted++;
        }
        if (DEBUG) var_dump($insert_res);
    }
} catch (\Dibi\Exception $e) {
    echo PHP_EOL . "Error: " . $e->getMessage() . " New CMS Plan: " . json_encode($new_cms_plan);
}
echo PHP_EOL . "Inserted $cnt_inserted records";

fclose($inp);
echo $populate_msg;

