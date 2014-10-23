<?php


namespace src\view\nav;



class NavView {
    private static $action = "action";

    public static $umlSubmit = "umlsubmit";
    public static $umlGetLists = "umlgetlists";
    public static $showProject = "showproject";
    public static $deleteProject = "deleteproject";

    public static $registerView = "registerview";
    public static $login = "login";
    public static $logoutView = "logoutview";

    public static function getAction(){
        if(isset($_GET[self::$action])){
            return $_GET[self::$action];
        }
        return self::$umlSubmit;
    }

    public static function redirectHome($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit.'&logout='.$string);
    }

    public static function redirectToUMLMSG($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit.'&welcome='.$string);
    }
    public static function redirectToUMLRegisterMSG($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit.'&register='.$string);
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:37
 */