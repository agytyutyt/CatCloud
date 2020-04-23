<?php


class loginService {
    public function checkLogin(){
        return $_SESSION["user"]=="" ? false : true;
    }

    public function checkPassword($username,$password){
        $stm=Command::checkAccount($username,$password);
        return Command::sudo($stm);
    }
}