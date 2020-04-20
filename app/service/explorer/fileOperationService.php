<?php

include_once ("./utils/commandUtils.php");

class fileOperationService{

    public function fileRename($fileName,$newName){
        $stm=Command::renameCommand($fileName,$newName,false);
        return Command::sudo($stm);
    }

    public function fileCreate($name,$path){
        $stm=Command::touch($path."/".$name);
        return Command::sudo($stm);
    }

    public function dirCreate($name,$path){
        $stm=Command::mkdir($path."/".$name);
        return Command::sudo($stm);
    }

    public function rmFile($name,$path,$type){
        $stm=Command::rm($path."/".$name,$type);
        return Command::sudo($stm);
    }

    public function getFileInfo($file,$dir){
        $stm=Command::ls_detail($file,$dir);            //获取命令
        $execResult=Command::sudo($stm);     //执行命令
        $return=Array();
        if($execResult["staCode"]==0){
            $temp=$execResult["output"][0];
//            $temp=strtok($temp," ");
            $return["code"]=0;
//            $return["type"]=($temp[0])[0];
//            $return["privilege"]=substr($temp[0],1);
//            $return["nodeCount"]=$temp[1];
//            $return["owner"]=$temp[2];
//            $return["group"]=$temp[3];
//            $return["size"]=$temp[4];
//            $return["recentTime"]=$temp[5].$temp[7]." ".$temp[8];
//            $return["pointTo"]=$temp[9];
            $temp=strtok($temp," ");
            $return["type"]=$temp[0];
            $return["privilege"]=substr($temp,1);
            $return["nodeCount"]=strtok(" ");
            $return["owner"]=strtok(" ");
            $return["group"]=strtok(" ");
            $return["size"]=strtok(" ");
            $return["recentTime"]=strtok(" ").strtok(" ")." ".strtok(" ");
        }
        else{
            $return["code"]=-1;
            $return["msg"]="出错了";
        }
        return $return;

    }

    public function changeOwner($file,$dir,$user){
        $stm=Command::chown($file,$dir,$user);
        return Command::sudo($stm);
    }

    public function changeGroup($file,$dir,$grp){
        $stm=Command::chgrp($file,$dir,$grp);
        return Command::sudo($stm);
    }

    public function changePri($file,$dir,$pri){
        $stm=Command::chmod($file,$dir,$pri);
        return Command::sudo($stm);
    }

    public function cpyFileTo($from, $to){
        $stm=Command::cp($from,$to);
        return Command::sudo($stm);
    }

    public function mvFileTo($from, $to){
        $stm=Command::mv($from,$to);
        return Command::sudo($stm);
    }
}