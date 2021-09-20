<?php

function fwriteln($f, $str){
    return fwrite($f, $str . PHP_EOL);
}
