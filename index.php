<?php
ob_start();
session_start();
include_once("config/config.php");
include ("app/Application.php");
$app = new Application();
$app->run();
?>

