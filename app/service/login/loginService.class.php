<?php


class loginService {
    public function checkLogin(){
        return $_SESSION["user"]=="" ? false : true;
    }
}