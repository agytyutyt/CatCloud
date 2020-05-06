<?php

//include ("./utils/commandUtils.php");
//include_once("./app/service/system/systemService.php");
//include_once("./app/service/login/loginService.class.php");
//
////$loginService=new loginService();
////
////print_r($loginService->checkPassword("drcat","12374111"));
//
//if(stripos("demo",".")==null){
//    echo "false";
//}

$time=$_SERVER['REQUEST_TIME'];
$arr=array("time"=>$time);
echo md5(json_encode($arr));
