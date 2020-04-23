<?php

define("R2P"," 2>&1");  //将错误信息输出重定向到标准输出

class Command{

    /**
     * @param $statement    //要执行的语句
     * @return array        //结果数组，包含 staCode 和 output
     * staCode 为状态码
     * output为输出数组
     */
    static public function do($statement){
        exec($statement,$output,$resultCod);
        return Array("staCode"=>$resultCod,"output"=>$output);
    }
    static public function sudo($statement){
        $preFix="sudo";
        exec("$preFix $statement",$output,$resultCod);
        error_log("Executed： ".$statement);
        return Array("staCode"=>$resultCod,"output"=>$output);
    }

    static public function checkAccount($username,$password){
        $path=realpath('./app/api')."/auth.out $username $password";
        return $path;
    }

    static public function renameCommand($oldFullName,$newFullName,$isDir=true){
        $option=$isDir?"-R":"";
        return "mv $option $oldFullName $newFullName".R2P;
    }

    static public function mkdir($dirName,$privilege="-1"){
        $op=$privilege==="-1"?"":$privilege;
        return "mkdir $dirName $op";
    }

    static public function touch($fileName,$privilege="-1"){
        $op=$privilege==="-1"?"":$privilege;
        return "touch $fileName $op";
    }

    static public function rm($fileName,$type){
        $op=$type==="file"?"":"-R";
        return "rm $op $fileName";
    }

    static public function ls_detail($name,$dir){
        return "ls -l $dir | grep $name";
    }

    static public function chown($name,$dir,$user) {
        $target=$dir."/".$name;
        return "chown -R $user $target";
    }

    static public function chgrp($name,$dir,$group){
        $target=$dir."/".$name;
        return "chgrp $group $target";
    }

    static public function chmod($name,$dir,$pri){
        $target=$dir."/".$name;
        return "chmod -R $pri $target";
    }

    static public function cp($from, $to){
        return "cp -R $from $to";
    }

    static public function mv($from, $to){
        return "mv $from $to";
    }

    static public function find($file,$path){
        return "find $path -name $file";
    }

}