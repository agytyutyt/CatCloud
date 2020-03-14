<?php

include("controller/loginController.class.php");
class Application{
    public function run(){
        $urlResult=parseUrl($_SERVER['REQUEST_URI']);
        $target=$urlResult["basename"];
        switch ($target){
            case "login":
                echo "login";
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