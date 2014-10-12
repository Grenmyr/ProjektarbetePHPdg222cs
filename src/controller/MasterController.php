<?php

namespace controller;

use src\view\nav\NavView;

class MasterController {

    public function render(){
        switch(NavView::getAction()){
            case NavView::$umlSubmit;
                $umlToCodeController = new UmlToCodeController();
                var_dump("case umlSubmit");
                $loginController = new LoginController();
                return  $loginController->checkLogin(). $umlToCodeController->body();
            case NavView::$umlSave;
                var_dump("case umlSave");
                $umlToCodeController = new UmlToCodeController();
                break;

            case NavView::$registerView;
                var_dump("case registerview");
                $registerController = new RegisterController();
                return $registerController->body();
            case NavView::$login;
                var_dump("case login");
                $loginController = new LoginController();
                return $loginController->login();
            case NavView::$logoutView;
                var_dump("case logoutview");
                $loginController = new LoginController();
                $loginController->logout();
                break;
            default:
                var_dump("case default");
                $umlToCodeController = new UmlToCodeController();
                $loginController = new LoginController();
                return  $loginController->checkLogin(). $umlToCodeController->body();

        }


    }



}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */