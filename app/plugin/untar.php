<?php

class untar{

    public function run(){
        $file=$_POST["file"];
        if (!file_exists($file)){
            echo false;
        }
        else{
            $target=substr($file,0,strripos($file,"/"));
            $stm="sudo tar -zxvf $file -C $target";
            exec($stm,$output,$resultCod);
            $result=array();
            if($resultCod!=0){
                $result["code"]=-1;
                $result["msg"]=$output;
            }
            else{
                $result["code"]=0;
                $result["msg"]=$output;
            }
        }
    }
}