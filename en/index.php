<?php

ini_set('display_errors', 1);
ini_set('max_execution_time', 300);
set_time_limit(300);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('HomeFOLDER', dirname($_SERVER['PHP_SELF']));
define('MainFilesPATH', ROOT . 'main' . DS);

try {
    require_once MainFilesPATH . 'Autoload.php';
    require_once MainFilesPATH . 'Configs.php';

    Session::init();
    Tracker::init();

    $registry = Registry::getInstance();
    $registry->request = new Request();
    $registry->db = new Database(DbHOST, DbNAME, DbUSER, DbPASS, DbCHAR);
    $registry->acl = new ACL();

    Bootstrap::run($registry->request);

} catch (Exception $e) {
    Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => $e->getMessage())));
    echo $e->getMessage();
}