<?php

include("controller/loginController.class.php");
include("controller/explorerController.class.php");
include("controller/apiController.class.php");

include ("filter/CORSFilter.php");



class Application{
    public function run(){
        $filter=new ReflectionClass("CORSFilter");
        $instance= $filter->newInstance();
        $instance->doFilter();

        $result=null;
        $urlResult=parseUrl($_SERVER['REQUEST_URI']);
        $controller=$urlResult["controllerName"];
        $method=$urlResult["methodName"];

        if($controller==="plugin"){
            $file=ROOTDIR."/app/plugin/".$method.".php";
            if(file_exists($file)){
                include_once ($file);
                $instance = new $method();
                $instance->run();
            }
        }
        else{
            try{
                $class=new ReflectionClass($controller."Controller");
                $instance= $class->newInstance();
                if ($method=="") $method="display";
                $result=$instance->$method();
            }catch(ReflectionException $e){
                echo "404";
            }
        }
    }
}