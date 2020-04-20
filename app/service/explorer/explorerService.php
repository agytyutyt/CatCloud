<?php

include_once ("./app/bean/File.class.php");



class explorerService {

    function __construct(){
//        $this->badgeService=new BadgeService();
    }

    public function utils_getDir($dirName){
        if(!is_dir($dirName)){
            throw new Exception("DirNotExist");
            return;
        }
        $result=array();
        if ($dh = opendir($dirName)){
            while (($file = readdir($dh)) !== false){
                $temp=array("name"=>$file,"isDir"=>!is_file($dirName."/".$file));
                if($file!="."&&$file!="..") {
                    array_push($result,$temp);
                }
            }
            closedir($dh);
        }
        return $result;
    }

    public function downloadFile($dir,$name){
        $result=array();
        if (! file_exists ( $dir ."/". $name )) {
            $result["code"]=-1;
            $result["msg"]="文件不存在";
        }
        else{
            //可在此添加加密信息或者计数信息，以限制文件的下载次数以及防止恶意下载。
            $result["code"]=0;
            $result["msg"]="http://localhost:8080/api/download?file=$dir/$name";
        }
        error_log("explorerService===========".$result["msg"]);
        return $result;
    }

}
