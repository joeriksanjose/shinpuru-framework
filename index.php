<?php
define('ROOT_DIR', __DIR__.'/');

require_once ROOT_DIR.'nucleo/shinpuru.php';

try {
    SpDispatcher::dispatch();
} catch (SpException $spe) {
    echo $spe->getMessage();
}