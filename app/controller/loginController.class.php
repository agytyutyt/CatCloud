<?php

include_once(ROOTDIR . "/app/service/login/loginService.class.php");
include_once(ROOTDIR . "/utils/authorizationUtils.php");

class loginController{
    private $loginService;

    function __construct(){
        $this->loginService=new loginService();
    }

    public function display(){
        include (ROOTDIR."/statis/login.html");
    }
    public function checkStatus(){
        if(!$this->loginService->checkLogin()) {
            header('Content-Type:application/json');
            $result=array("asd"=>123);
            echo json_encode($result);
        }
    }
    public function checkAccount(){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $pwdResult=$this->loginService->checkPassword($username,$password);
        if($pwdResult["output"][0]=="true"){
            $pwdResult["output"]=true;
            $home=getHomeDir($username);
            $pwdResult["home"]=$home;
            $pwdResult["name"]=$username;
            $_SESSION["user"]=$username;
        }
        else if ($pwdResult["output"][0]=="false"){
            $pwdResult["output"]=false;
        }
        echo json_encode($pwdResult);
    }
}