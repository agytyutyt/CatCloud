<?php


class loginService {
    public function checkLogin(){
        return $_SESSION["user"]=="" ? false : true;
    }

    /**
     * @param $username
     * @param $password
     * @return array  "staCode"=> 0 for success, others for failed
     *                "output[0]=> true for success, false for failed
     */
    public function checkPassword($username,$password){
        $stm=Command::checkAccount($username,$password);
        return Command::sudo($stm);
    }
}