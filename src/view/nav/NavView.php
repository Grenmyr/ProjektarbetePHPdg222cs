<?php


namespace src\view\nav;



use src\view\MemberView;

class NavView {
    //All Views use this variables to handle paging.
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

    // Dependant to Settings::$ROOT_PATH
    public static function redirectHome($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit .$string);
    }
    // Dependant MemberView::$welcome also dependant to Settings::$ROOT_PATH
    public static function redirectToUMLMSG($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit.'&'.MemberView::$welcome.'='.$string);
    }
    // Dependant MemberView::$register also dependant to Settings::$ROOT_PATH
    public static function redirectToUMLRegisterMSG($string) {
        header('Location: /' . \Settings::$ROOT_PATH. '/?'.self::$action.'='.self::$umlSubmit.'&'.MemberView::$register.'='.$string);
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:37
 */