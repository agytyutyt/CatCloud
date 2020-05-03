<?php

include ("./app/service/explorer/explorerService.php");
include ("./app/service/explorer/fileOperationService.php");
include_once ("./app/service/explorer/BadgeService.php");

class explorerController{
    private $explorerService;
    private $fileOperationService;
    function __construct(){
        $this->explorerService=new explorerService();
        $this->fileOperationService=new fileOperationService();
    }

    function getDir(){
        $dirName=$_GET["dirname"];
        //echo json_encode($this->explorerService->utils_getDir("$dirName"));
        try{
            $dir=$this->explorerService->utils_getDir("$dirName");
            sort($dir);
            echo json_encode($dir);
        }catch (Exception $e){
           $error=$e->getMessage();
           $result=array("error"=>$error);
           echo json_encode($result);
        }

//        print_r($dir);
    }

    function dirRename(){
        $oldName=$_POST["oldName"];
        $newName=$_POST["newName"];

        $execResult=$this->fileOperationService->fileRename($oldName,$newName);
        $return=array();
        $return["code"]=$execResult["staCode"];
        $return["msg"]=$execResult["output"];
        echo json_encode($return);
    }

    function newFile(){
        $name=$_POST["name"];
        $type=$_POST["type"];
        $currentDir=$_POST["currentDir"];
        $pri=$_POST["pri"];

        $execResult_1="";
        $execResult_2="";

        if($type==="dir"){
            $execResult_1=$this->fileOperationService->dirCreate($name,$currentDir);
            $execResult_2=$this->fileOperationService->changePri($name,$currentDir,$pri);
        }
        else if($type==="file"){
            $execResult_1=$this->fileOperationService->fileCreate($name,$currentDir);
            $execResult_2=$this->fileOperationService->changePri($name,$currentDir,$pri);
        }

        $return=array();
        $return["code"]=($execResult_1["staCode"]==0&&$execResult_2["staCode"]==0)?"0":"-1";
        $return["msg"]=array($execResult_1["output"],$execResult_2["output"]);
        echo json_encode($return);
    }

    function deleteFile(){
        $name=$_POST["name"];
        $type=$_POST["type"];
        $currentDir=$_POST["currentDir"];

        $execResult=$this->fileOperationService->rmFile($name,$currentDir,$type);
        $return=array();
        $return["code"]=$execResult["staCode"];
        $return["msg"]=$execResult["output"];
        echo json_encode($return);
    }

    function getFileInfo(){
        $dir=$_POST["currentDir"];
        $name=$_POST["name"];

        //交给service
       echo json_encode($this->fileOperationService->getFileInfo($name,$dir));
    }

    function editInfo(){
        $type=$_POST["type"];
        $value=$_POST["value"];
        $file=$_POST["file"];
        $dir=$_POST["currentDir"];
        $execResult="";
        switch ($type){
            case "name": {
                $execResult=$this->fileOperationService->fileRename($dir."/".$file,$dir."/".$value);
                break;
            }
            case "owner": {
                $execResult=$this->fileOperationService->changeOwner($file,$dir,$value);
                break;
            }
            case "group": {
                $execResult=$this->fileOperationService->changeGroup($file,$dir,$value);
                break;
            }
            case "pri": {
                $execResult=$this->fileOperationService->changePri($file,$dir,$value);
                break;
            }
        }
        $return=array();
        $return["code"]=$execResult["staCode"];
        $return["msg"]=$execResult["output"];
        echo json_encode($return);
    }

    function downFile(){
        $dir=$_POST["currentDir"];
        $name=$_POST["name"];
        echo json_encode($this->explorerService->downloadFile($dir,$name));
    }

    function upFile(){
        $sessionId=session_id();
        $time=$_SERVER['REQUEST_TIME'];
        $count=$_POST["count"];

        //以md5值作为键，文件数作为值，存于session中，每上传一个文件，值减一。
        $badge=BadgeService::uploadRequest($sessionId,$time);
        $_SESSION[$badge]=$count;
//        error_log("Controller======".$_SESSION[$badge]);
        echo json_encode(array("badge"=>$badge));
//        print_r($_SESSION);
    }

    function copyFile(){
        $from=$_POST["from"];
        $to=$_POST["to"];

        $execResult=$this->fileOperationService->cpyFileTo($from,$to);
        $return=array();
        $return["code"]=$execResult["staCode"];
        $return["msg"]=$execResult["output"];
        echo json_encode($return);
    }

    function moveFile(){
        $from=$_POST["from"];
        $to=$_POST["to"];

        $execResult=$this->fileOperationService->mvFileTo($from,$to);
        $return=array();
        $return["code"]=$execResult["staCode"];
        $return["msg"]=$execResult["output"];
        echo json_encode($return);
    }
}



