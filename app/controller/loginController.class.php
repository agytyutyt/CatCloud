<?php


class loginController{
    public function checkLogin(){
        return $_SESSION["user"]=="" ? false : true;
    }
}