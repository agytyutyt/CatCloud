<?php

include ("./utils/commandUtils.php");
include_once("./app/service/system/systemService.php");

$sysService=new systemService();

print_r($sysService->diskInfo());
