<?php

class CORSFilter{

    public function doFilter(){
        if($_SERVER["REQUEST_METHOD"]=="OPTIONS") {
            error_log("Option Request Filter From".$_SERVER['REQUEST_URI']);
//            exit();
        }
    }
}