<?php
ob_start();
include_once("utils/commonUtils.php");
session_start();

error_log("This is index_test.php");

echo '用户地址：'.$_SERVER['REMOTE_ADDR'];
echo "<br>";
echo '请求地址：'.$_SERVER['REQUEST_URI'];
echo "<br>";
echo 'SessionId：'.session_id();
//echo '<br>';
//echo "a的值：".$_POST['a'];
echo '<br>';
echo is_dir("/");
echo '<br>';
//read_dir("/home");

if(!is_dir("/home/drcat/hello")){
    echo "/cat 目录未存在<br>";
    echo "正在创建目录......<br>";
    if(mkdir("/home/drcat/hello",0777)) echo "创建目录成功<br>";
    if(is_dir("/home/drcat/hello")) {
        echo "/cat 目录已存在<br>";
    } else {
        echo "创建目录失败<br>";
    }
}
else{
    echo "/home/drcat/hello 路径已存在";
}
echo "<br>";

$dir="/";
if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            echo "filename:" . $file . "<br>";
        }
        closedir($dh);
    }
}
?>