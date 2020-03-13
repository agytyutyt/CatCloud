<?php
ob_start();
session_start();

include_once("utils/requestUtils.php");

$url=$_SERVER['REQUEST_URI'];
$arr=pathinfo($url);
print_r($arr);
echo "<br>";
echo $url;
echo "<br>";
$temp=parseUrl($url);
//print_r($temp);