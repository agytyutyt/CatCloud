<?php
/*
 * 解析结果：
 * rootDir：起始目录;
 * targetName：目标名;
 * fullTargetName：目标文件名;
 * extension(若存在)：目标文件扩展名;
 * argus：$_GET方法参数;
 */
function parseUrl($url){
    $path=pathinfo($url);
    $result=array(
        "rootDir"=>$path["dirname"],            //起始路径
        "targetName"=>$path["basename"],        //目标名
        "fullTargetName"=>$path["filename"],    //目标文件全名
        "extension"=>$path["extension"]         //目标文件扩展名
    );
    parseArugs($path['basename']);
    return $result;
}

/**
 * @param $url  传入参数，最好是去掉ip地址后的详细路径名   例：/desktop?a=1&b=2%c=3
 * @return array 解析结果，返回一个数组，为GET请求的参数，key=>value.  例：Array(a=>1,b=>2,c=>3)
 */
function parseArugs($url){
    $pos=strpos($url,"?");
    $pos++;
    $subUrl=substr($url,$pos);
    $result=explode("&",$subUrl);
    for($i=0;$i<count($result);$i++){
        $temp=explode("=",$result[$i]);
        $result[$temp[0]]=$temp[1];
        unset($result[$i]);
    }
    return $result;
}