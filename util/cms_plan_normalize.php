<?php
/*
 * Normalize CMS' cplan_full table into cplan
 * Truncate cplan table
 * And populate cplan_full into cplan table. Only save 1 plan_id per formulary (group by)
 */
require_once __DIR__ . '/../vendor/autoload.php';

use Dibi\Connection;

//const DEBUG = false;
const DEBUG = true;
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

$populate_msg = '';
//contract_id|plan_id|segment_id|contract_name                      |plan_name
//|formulary_id|premium|deductible|icl|ma_region_code|pdp_region_code|state|county_code|snp|plan_suppressed_yn
//H0022     |001    |000        |BUCKEYE COMMUNITY HEALTH PLAN, INC.|Buckeye Health Plan - MyCare Ohio (Medicare-Medicaid Plan)
//|00021467     |0.00   |0          |.|              |              |OH     |36110      |0|N

try {
    $cnt_inserted = 0;
    $db->query('TRUNCATE TABLE cplan');

    $result = $db->query('select max(contract_id) AS contract_id, max(plan_id) AS plan_id, max(contract_name) AS contract_name
    , max(plan_name) AS plan_name, formulary_id, max(state) AS state, MIN(plan_suppressed_yn) AS plan_suppressed_yn, max(note) AS note
from cplan_full
group by formulary_id
');
    $norm_cplans = $result->fetchAll();
    foreach ($norm_cplans as $norm_cplan) {
        if (DEBUG) var_dump($norm_cplan);
        /*$contract_id = $vals[0];
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
        }*/


        $insert_res = $db->query("INSERT INTO cplan", $norm_cplan);

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
    echo PHP_EOL . "Error: " . $e->getMessage() . " New CMS Plan: " . json_encode($norm_cplan);
}
echo PHP_EOL . "Inserted $cnt_inserted records";

echo $populate_msg;

