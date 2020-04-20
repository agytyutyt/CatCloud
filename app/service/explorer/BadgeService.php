<?php

class BadgeService{
    static public function uploadRequest($sessionId,$time){
        $sourStr=$sessionId."-".$time;
        return md5($sourStr);
    }

    static public function rev_uploadRequest($md5){

    }
}