<?php
/*
 * Export RXNCONSO Sing from inp/rxnconsosing.tsv into out/fda_ndc.js
 * Input: tsv file
 * End result: JS array declaration
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/phelper.php';

const DEBUG = false;
//const DEBUG = true;
const JS_LINE_MAX_CHAR = 200;
$longopts = array(
//    "required:",     // Required value
    "mode::",    // Optional value.
    //mode: 1/ php
    // 2/ sed
);
$options = getopt('', $longopts);
$mode = $options['mode'] ?? 'file';
if (DEBUG) var_dump($options);


//$inp = fopen(__DIR__ . '/inp/rxnconsosing.tsv', 'r');
$inp = fopen(__DIR__ . '/inp/rxnconsosing_full.tsv', 'r');
$out = fopen(__DIR__ . '/out/rxnconsosing.js', 'w+');
$populate_msg = '';
if (! $inp || ! $out) die('File not found');

$DB_COLS = ['s', 'i', 's'];

fwriteln($out, '//cols: ' . 'rxcui,id,str');
fwriteln($out, '//cols: ' . implode(',',$DB_COLS));
fwriteln($out, 'const RXNCONSO_SING = [');

//start building js array
$cur_char_count = 0;//count chars in line
$cur_row_count = 0;//cur row count
$header = fgets($inp);
while ($row = trim(fgets($inp))) {
    $a_line = '[';
    $cur_row_count++;
    //escape string
    $col_vals = explode("\t", $row);
    foreach ($col_vals as $i => &$col_val) {
        if (!isset($DB_COLS[$i])){
            echo "Error: index $i, col values: " . json_encode($col_vals);
            die(-1);
        }
        switch ($DB_COLS[$i]) {
//            case 'i': break;
            case 's':
                $col_val = str_replace('"', '', $col_val);
                $col_val = "'" . addslashes($col_val) . "'";
                break;
            default:
                break;
        }
    }
    $a_line .= implode(',', $col_vals);
    $a_line .= '],';
    if ($cur_row_count % 4 == 0) fwriteln($out, $a_line);
    else fwrite($out, $a_line);
}
fwrite($out, ']');

fclose($inp);
fclose($out);
echo $populate_msg;

