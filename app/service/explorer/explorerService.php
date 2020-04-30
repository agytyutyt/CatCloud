<?php

include_once ("./app/bean/File.class.php");
include_once ("./utils/commonUtils.php");



class explorerService {

    function __construct(){
//        $this->badgeService=new BadgeService();
    }

    public function utils_getDir($dirName){
        if(!is_dir($dirName)){
            $pos=strripos($dirName,"/");
            if($pos==0||$pos==false){
                throw new Exception("DirNotExist");
                return;
            }
            else{
                $sub_dir=substr($dirName,0,$pos);
                if(!is_dir($sub_dir)){
                    throw new Exception("DirNotExist");
                    return;
                }
                else{
                    $dirName=$sub_dir;
                }
            }
        }
        $result=array();
        if ($dh = opendir($dirName)){
            while (($file = readdir($dh)) !== false){
                $extension="";
                if(stripos($file,".")==null){
                    $extension=false;
                }
                else{
                    $extension=substr($file,stripos($file,".")+1);
                }
                $temp=array(
                    "name"=>$file,
                    "isDir"=>!is_file($dirName."/".$file),
                    "mdfTime"=>filemtime($dirName."/".$file),
                    "type"=>filetype($dirName."/".$file),
                    "extension"=>$extension
                );
                if($temp["isDir"]==true) $temp["size"]=false;
                else{
                    $temp["size"]=formatSize(filesize($dirName."/".$file));
                }
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

    public function findFile($file,$path){
        $stm=Command::find($file,$path);
        return Command::sudo($stm);
    }
}
