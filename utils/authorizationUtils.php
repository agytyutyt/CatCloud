<?php

/**
 * @param $controller String 要访问的内容名称
 * @return bool 返回值为true,表示需要登录；返回值为false,则表示不需要登录。
 */
function dispatchFilter($controller){
    switch ($controller){
        case "login":
            echo "login";
            return false;
            break;
        case "help":
            echo "help";
            return false;
            break;
        default:
            return true;
            break;
    }
}