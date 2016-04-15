<?php
/**
 * Created by PhpStorm.
 * User: session2
 * Date: 4/7/16
 * Time: 4:00 PM
 */
session_start();

if($_SESSION['userSession'] == true){

session_destroy();
$_SESSION['userSession'] = false;
header('location: http://localhost:8090/Subscription%20Service%20Project_PHP%20&%20MySQL/login.php');
exit;

};