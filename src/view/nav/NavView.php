<?php


namespace src\view\nav;


class NavView {
    private static $action = "action";

    public static $guestView = "guestview";
    public static $registerView = "registerview";

    public static function getAction(){
        if(isset($_GET[self::$action])){
            return $_GET[self::$action];
        }
        return self::$registerView;
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:37
 */