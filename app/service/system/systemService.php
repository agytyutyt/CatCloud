<?php

include_once "./utils/commandUtils.php";

class systemService{
    public function diskInfo(){
        $stm="sudo df --block-size 1 | grep /sd[abcdefghijklmnopqrstuvwxyz]";
        $checkResult=Command::sudo($stm)["output"];
        $result=array();
        for($i=0;$i<count($checkResult);$i++){
            //文件系统__1bit-块__已用__可用__已用%__挂载点
//            $fileSystem=strtok($checkResult[$i]," ");
//            $block=strtok(" ");
//            $used=strtok(" ");
//            $available=strtok(" ");
//            $usedPercent=strtok(" ");
//            $mountPoint=strtok(" ");
            $disk=array();
            $disk["fileSystem"]=strtok($checkResult[$i]," ");
            $disk["block"]=strtok(" ");
            $disk["used"]=strtok(" ");
            $disk["available"]=strtok(" ");
//            $disk["usedPercent"]=strtok(strtok(" "),"%");
            $disk["usedPercent"]=strtok(" ");
            $disk["mountPoint"]=strtok(" ");
            $disk["usedPercent"]=strtok($disk["usedPercent"],"%");
            array_push($result,$disk);
        }
        return $result;
    }
}