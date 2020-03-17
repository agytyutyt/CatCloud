<?php

include("controller/loginController.class.php");

class Application{
    public function run(){
        $result=null;
        $urlResult=parseUrl($_SERVER['REQUEST_URI']);
        $controller=$urlResult["controllerName"];
        $method=$urlResult["methodName"];
        switch ($controller){
            case "login":
                $class=new ReflectionClass($controller."Controller");
                $instance= $class->newInstance();
                if ($method=="") $method="display";
                $result=$instance->$method();
                break;
            case "desktop":
                echo "desktop";
                break;
            case "default":
                echo "default";
                break;
        }
    }
}