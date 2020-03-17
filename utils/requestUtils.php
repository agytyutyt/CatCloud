<?php

set_error_handler("myNoticeHandler");

/**
 * @return 解析结果：
 *          controllerName：控制器名;
 *          methodName：方法名;(如果存在)
 *          argus：$_GET方法参数;(如果存在)
 */
function parseUrl($url){
    $result=Array(
        "controllerName"=>"",
        "methodName"=>"",
        "argus"=>""
    );
    reset($result);
    for($pos=myUrlFindNext($url, 0) ; $pos!==false ; ) {
        $start=$pos;
        $pos = myUrlFindNext($url, $start+1);
        if($pos==false) {
            $result[key($result)]=substr($url,$start+1);
            break;
        }
        else {
            $result[key($result)]=substr($url,$start+1,$pos-$start-1);
            next($result);
        }
        if ($url[$pos] == "?") {
            $argus = parseArugs($url, $pos);
            $result["argus"] = $argus;
            break;
        }
    }
    return $result;
}

/**
 * @param $url  传入参数，最好是去掉ip地址后的详细路径名   例：/desktop?a=1&b=2%c=3
 * @param int $pos 可选参数，默认为-1，代表自行寻找。
 * @return array 解析结果，返回一个数组，为GET请求的参数，key=>value.  例：Array(a=>1,b=>2,c=>3)
 */
function parseArugs($url,$pos=-1){
    if($pos==-1) $pos=strpos($url,"?");  //寻找url的参数区
    $pos++;
    $subUrl=substr($url,$pos);  //截取参数
    $result=explode("&",$subUrl);   //参数分离
    for($i=0;$i<count($result);$i++){
        $temp=explode("=",$result[$i]); //参数分离
        $result[$temp[0]]=$temp[1]; //加入结果数组
        unset($result[$i]); //去除数组中多余项
    }
    return $result;
}

/**
 * @return 数组，分别为每一个 "/" 在 $url 中出现的索引,当出现false,表明到了结尾
 * @param $url  传入的 url 参数
 */
function findURLPos($url){
    $temp=-1;
    $i=0;
    $result=array();
    while(1){
        $temp=strpos("$url","/",$temp+1);
        if($temp===false) break;
        $result[$i++]=$temp;
    }
    return $result;
}

/*
 * 重写 Notice 错误的处理方法，忽略该错误，不抛出。
 */
function myNoticeHandler($type, $message, $file, $line){
//    error_log("====== type ====== ".$type);
//    error_log("====== message ====== ".$message);
//    error_log("====== file ====== ".$file);
//    error_log("====== line ====== ",$line);
}

function myUrlFindNext($str,$start=0){
    $c=strlen($str);
    for($i=$start;$i<$c;$i++){
        if($str[$i]==="/" || $str[$i]==="?"){
            return $i;
        }
    }
    return false;
}