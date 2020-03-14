<?php
ob_start();
session_start();
include_once("config/config.php");
include ("app/Application.php");
$app = new Application();
$app->run();

//if(dispatchFilter($urlResult["basename"])){
//    echo "请登录";
//}
//else{
//    echo"无需登录";
//    include("statis/demo.html");
//}

