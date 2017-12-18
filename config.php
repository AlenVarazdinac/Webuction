<?php

session_start();

include_once 'functions.php';

$appName = 'Webuction';
$appPath = '/projects/webuction/';
$appVersion = '0.2.0';

if($_SERVER['HTTP_HOST'] === 'localhost') {
    $appPath = '/projects/webuction/';
    $mysqlHost = 'localhost';
    $mysqlDatabase = 'webuction';
    $mysqlUser = 'varazdinac';
    $mysqlPw = '123';
}

try {
    $conn = new PDO('mysql:host=' . $mysqlHost . ';dbname=' . $mysqlDatabase,$mysqlUser,$mysqlPw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->exec('SET CHARACTER SET utf8');
    $conn->exec('SET NAMES utf8');
    $conn->exec('SET FOREIGN_KEY_CHECKS = 0');
} catch(PDOException $e) {
    switch($e->getCode()) {
        case 2002:
        echo "Can not connect to MySQL Server";
        break;

        case 1049:
        echo "Database with name you provided does not exits on MySQL Server";
        break;

        case 1045:
        echo "Combination of Name and Password does not exist on MySQL Server";
        break;

        default:
        print_r($e);
        break;
    }
    exit;
}

?>
