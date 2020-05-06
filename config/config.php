<?php
define("nLine","<br>");
define("ROOTDIR",$_SERVER['DOCUMENT_ROOT']);

$web=$_SERVER["HTTP_ORIGIN"];

include_once("utils/requestUtils.php");
include_once("utils/authorizationUtils.php");
include_once("utils/commonUtils.php");

if(!$web) header('Access-Control-Allow-Origin: http://localhost:8081');
else header('Access-Control-Allow-Origin:'.$web);
//header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // 允许option，get，post请求
header('Access-Control-Allow-Methods: *'); // 允许option，get，post请求
//header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); // 允许x-requested-with请求头
header('Access-Control-Allow-Credentials:true');//表示是否允许发送Cookie

?>