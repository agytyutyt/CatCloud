<?php

include_once ("./app/service/explorer/explorerService.php");
include_once("./app/service/system/systemService.php");

class apiController{

    private $explorerService;
    private $systemService;
    function __construct(){
        $this->explorerService=new explorerService();
        $this->systemService=new systemService();
    }

    public function download(){
        $filePath=$_GET["file"];
        $name=substr($filePath,strrpos($filePath,"/")+1);

        if (! file_exists ($filePath)) {
            header('HTTP/1.1 404 NOT FOUND');
        } else {
            //以只读和二进制模式打开文件
            $file = fopen ($filePath, "rb" );

            $fileSize=filesize($filePath);
            clearstatcache();
            //告诉浏览器这是一个文件流格式的文件
            Header ( "Content-type: application/octet-stream" );
            //请求范围的度量单位
            Header ( "Accept-Ranges: bytes" );
            //Content-Length是指定包含于请求或响应中数据的字节长度
            Header ( "Accept-Length: " . $fileSize);
            //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
            Header ( "Content-Disposition: attachment; filename=" . $name );

            $read_buffer = 4096;
            $sum_buffer = 0;
            while(!feof($file) && $sum_buffer<$fileSize) {
                echo fread($file,$read_buffer);
                $sum_buffer += $read_buffer;
            }
            //读取文件内容并直接输出到浏览器
            fclose ( $file ); //打开的时候要进行关闭这个文件
            exit ();
        }
    }

    public function upload(){
        $badge=$_GET["badge"];
        $count=$_SESSION[$badge];
//        error_log("count===========".$count);
//        error_log("session=======".session_id());
//        print_r( $_SESSION);
        if($_SESSION[$badge]--<=0) exit();

        if ($_FILES["file"]["error"] > 0)
        {
            error_log("错误：" . $_FILES["file"]["error"]);
        }
        else
        {
            error_log("上传文件名: " . $_FILES["file"]["name"]);
            error_log("文件类型: " . $_FILES["file"]["type"]);
            error_log("文件大小: " . ($_FILES["file"]["size"] / 1024)." kB");
            error_log("文件临时存储的位置: " . $_FILES["file"]["tmp_name"]);
            //保存文件
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
        }
//        error_log(session_id());
    }

    public function getDir(){
        $dir=$_POST["dir"];
        $dir=$this->explorerService->utils_getDir($dir);
        sort($dir);
        echo json_encode($dir);
    }

    public function getHomePath(){
        $user="drcat";
        echo json_encode(array("dir"=>"/home/drcat"));
    }

    public function searchFile(){
        $file=$_POST["file"];
        $path=$_POST["path"];

        $result=$this->explorerService->findFile($file,$path);
        echo json_encode($result);
    }

    public function checkLogin(){
        $result=array();
        $result["user"]=$_SESSION["user"];
        if($result["user"]){
            $result["code"]=0;
        }
        else{
            $result["code"]=-1;
        }
        echo json_encode($result);
    }

    public function getDiskInfo(){
        try {
            $disks=$this->systemService->diskInfo();
            $result=array();
            $result["staCode"]=0;
            $result["disks"]=$disks;
            echo json_encode($result);
        }catch (Exception $exception){
            $result=array("staCode"=>-1);
            echo json_encode($result);
        }

    }
}