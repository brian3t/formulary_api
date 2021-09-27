<?php
/*
 * Group RXNCONSO table into rxconso_sing
 * Keep only one TTY from rxnconso
 *
 */
require_once 'rb.php';
const DEBUG = false;
//const DEBUG = true;
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
    R::freeze( true ); //will freeze redbeanphp
} catch (Exception $exception) {
    echo "Error connecting " . $exception->getMessage();
    return;
}
//for version 5.3 and higher
//optional but recommended
R::useFeatureSet('novice/latest');

$populate_msg = '';
$rxcuis = R::getAll("SELECT DISTINCT(rxcui) FROM RXNCONSO" . (DEBUG ? " LIMIT $LIMIT " : ''));

//if (DEBUG) var_dump($cols);
try {
    $count_populated = 0;
    foreach ($rxcuis as ['rxcui' => $rxcui]) {
//    if (DEBUG) var_dump($row);
        R::hunt('rxnconsosing', "rxcui = :rxcui", ['rxcui' => $rxcui]);

        $longest_tty = R::find("RXNCONSO", "RXCUI = :rxcui ORDER BY STR LIMIT 1", ['rxcui' => $rxcui]);
        if (! is_array($longest_tty) || count($longest_tty) != 1) continue;
        $longest_tty = array_pop($longest_tty);
        if (!$longest_tty instanceof \RedBeanPHP\OODBBean) {
            $populate_msg .= "Error, longest_tty not an object, rxcui: $rxcui " . PHP_EOL;
            continue;
        }
        //longest_tty is a bean OODBBean

        $longest_tty_props = $longest_tty->getProperties();
        $longest_tty_props_lowercase = [];
        foreach ($longest_tty_props as $key => $longest_tty_prop) {
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

