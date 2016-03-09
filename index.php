<?php

ob_start();

if (false == file_exists('app/config/database.conf.php')) {
    exit('Access "/install" to start installation');
}

include 'app/init.php';

try {
    $requester = app()->requester();
    $requester->dispatch();
    echo $requester->getResponse()->flush();
} catch (Exception $ex) {
    // how to process in this errors?
}