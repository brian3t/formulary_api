<?php
/*
 * Export FDA NDC from inp/fda_ndc.csv into out/fda_ndc.js
 * Input: csv file
 * End result: JS array declaration
 */
require_once __DIR__ . '/../vendor/autoload.php';

const DEBUG = false;
//const DEBUG = true;

$inp = fopen(__DIR__ . '/inp/fda_ndc.csv', 'r');
//$inp = fopen(__DIR__ . '/inp/fda_ndc_full.csv', 'r');
$populate_msg = '';
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
        $row = str_replace("\r", '', $row);
        $row = str_replace("\n", '', $row);
        $vals = explode("\t", $row);
//        if (DEBUG) var_dump($vals);
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

