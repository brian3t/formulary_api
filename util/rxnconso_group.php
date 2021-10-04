<?php
/*
 * Group RXNCONSO table into rxconso_sing
 * Keep only one TTY from rxnconso
 *
 * Modulo Parallel Processing MPP 10/1/21
 *
 */
require_once 'rb.php';
const DEBUG = false;
//const DEBUG = true;
if (DEBUG) $LIMIT = 5; else $LIMIT = PHP_INT_MAX;

const MPP_NUM_THREAD = 2;
$longopts = array(
    "MPPi:",     // Required. MPP index: 0, 1, etc.. Depends on MPP_NUM_THREAD
    //"optional::",    // Optional value.
    //mode: 1/ php
    // 2/ sed
);
$options = getopt('', $longopts);
if (! isset($options['MPPi'])) die('Must pass parameter MPPi');
$MPPi = $options['MPPi'];

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
    R::freeze(true); //will freeze redbeanphp
} catch (Exception $exception) {
    echo "Error connecting " . $exception->getMessage();
    return;
}
//for version 5.3 and higher
//optional but recommended
R::useFeatureSet('novice/latest');

$populate_msg = '';
$rxcuis = R::getAll("SELECT DISTINCT(con.rxcui) FROM RXNCONSO con LEFT OUTER  JOIN rxnconsosing sing ON con.RXCUI=sing.RXCUI 
WHERE sing.id IS NULL AND (con.RXCUI % ?) = ? "
    . (DEBUG ? " LIMIT $LIMIT " : ''), [MPP_NUM_THREAD, $MPPi]);
echo sizeof($rxcuis) . " rxcui not having rxnconsosing" . PHP_EOL;

//prepare list of all RXNCONSO into memory
$rxnconsos = R::getAll("SELECT con.* FROM RXNCONSO con LEFT OUTER  JOIN rxnconsosing sing ON con.RXCUI=sing.RXCUI 
WHERE sing.id IS NULL AND (con.RXCUI % ?) = ? "
    . (DEBUG ? " LIMIT $LIMIT " : ''), [MPP_NUM_THREAD, $MPPi]);
$rxnconsos_by_rxcui = [];
foreach ($rxnconsos as $r) {
    $cur_rxcui = $r['RXCUI'];
    if (! isset($rxnconsos_by_rxcui[$cur_rxcui]))
        $rxnconsos_by_rxcui[$cur_rxcui] = $r;
    if ($rxnconsos_by_rxcui[$cur_rxcui]['STR'] < $r['STR'])
        $rxnconsos_by_rxcui[$cur_rxcui] = $r;
}
unset($rxnconsos);

//if (DEBUG) var_dump($cols);
try {
    $count_populated = 0;
    foreach ($rxcuis as ['rxcui' => $rxcui]) {
//    if (DEBUG) var_dump($row);
        R::hunt('rxnconsosing', "rxcui = :rxcui", ['rxcui' => $rxcui]);

        $longest_tty = $rxnconsos_by_rxcui[$rxcui];
        if (! is_array($longest_tty) || count($longest_tty) != 18) continue;

        $longest_tty_props_lowercase = [];
        foreach ($longest_tty as $key => $longest_tty_prop) {
            $longest_tty_props_lowercase[strtolower($key)] = $longest_tty_prop;
        }
        $rxnconso_sing_b = R::dispense('rxnconsosing');
        $rxnconso_sing_b->rxcui = $longest_tty_props_lowercase['rxcui'];
        $rxnconso_sing_b->lat = $longest_tty_props_lowercase['lat'];
        $rxnconso_sing_b->ts = $longest_tty_props_lowercase['ts'];
        $rxnconso_sing_b->lui = $longest_tty_props_lowercase['lui'];
        $rxnconso_sing_b->stt = $longest_tty_props_lowercase['stt'];
        $rxnconso_sing_b->sui = $longest_tty_props_lowercase['sui'];
        $rxnconso_sing_b->ispref = $longest_tty_props_lowercase['ispref'];
        $rxnconso_sing_b->rxaui = $longest_tty_props_lowercase['rxaui'];
        $rxnconso_sing_b->saui = $longest_tty_props_lowercase['saui'];
        $rxnconso_sing_b->scui = $longest_tty_props_lowercase['scui'];
        $rxnconso_sing_b->sdui = $longest_tty_props_lowercase['sdui'];
        $rxnconso_sing_b->sab = $longest_tty_props_lowercase['sab'];
        $rxnconso_sing_b->tty = $longest_tty_props_lowercase['tty'];
        $rxnconso_sing_b->code = $longest_tty_props_lowercase['code'];
        $rxnconso_sing_b->str = $longest_tty_props_lowercase['str'];
        $rxnconso_sing_b->srl = $longest_tty_props_lowercase['srl'];
        $rxnconso_sing_b->suppress = $longest_tty_props_lowercase['suppress'];
        $rxnconso_sing_b->cvf = $longest_tty_props_lowercase['cvf'];
        $insert_res = R::store($rxnconso_sing_b);
        if ($insert_res !== 1) {
            $populate_msg .= ". Warning: ndc not saved";
        }
        $count_populated++;
        if (DEBUG) echo($insert_res);
    }
} catch (\Dibi\Exception $e) {
    echo PHP_EOL . "Error: " . $e->getMessage() . " New NDC: " . json_encode($longest_tty_props_lowercase);
}

echo $populate_msg . " count populated: $count_populated" . PHP_EOL;

