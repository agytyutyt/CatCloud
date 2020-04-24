<?php

/**
 * @param $controller String 要访问的内容名称
 * @return bool 返回值为true,表示需要登录；返回值为false,则表示不需要登录。
 */
function dispatchFilter($controller){
    switch ($controller){
        case "login":
            echo "dispatchFilter(): login".nLine;
            return false;
            break;
        case "help":
            echo "dispatchFilter(): help".nLine;
            return false;
            break;
        default:
            return true;
            break;
    }
}

function getAllUser(){
    exec("cat /etc/passwd",$res);
    //注册名：口令：用户标识号：组标识号：用户名：用户主目录：命令解释程序
    $result=array();
    for($i=0;$i<count($res);$i++){
        $explodeResult=explode(":",$res[$i]);
        if($explodeResult[6]=="/bin/bash"){
            array_push($result,$explodeResult);
        }
    }
    return $result;
}

function getHomeDirByUser($user){
    $users=getAllUser();
    $result="";
    for($i=0;$i<count($users);$i++){
        if ($users[$i][0]===$user){
            $result=$users[$i][5];
        }
    }
    return $result;
}