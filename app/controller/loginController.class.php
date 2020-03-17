<?php

include_once (ROOTDIR."/app/service/loginService.class.php");

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

    }
}