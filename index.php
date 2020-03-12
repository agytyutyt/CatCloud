<?php
ob_start();
session_start();
$url=$_SERVER['REQUEST_URI'];
$ar=pathinfo($url);
print_r($ar);