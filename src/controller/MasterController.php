<?php

namespace controller;

use src\view\nav\NavView;

class MasterController {

    public function render(){
        switch(NavView::getAction()){
            /*case NavView::$guestView;
                //$controller = new ViewController();
                var_dump("case guestview");
                $loginController = new LoginController();
                //$controller->body() .
                return $loginController->body();*/
            case NavView::$registerView;
                var_dump("case registerview");
                $controller = new RegisterController();
                return $controller->body();
            case NavView::$login;
                var_dump("case login");
                $controller = new LoginController();

                return $controller->login();
            case NavView::$logoutView;
                var_dump("case logoutview");
                $controller = new LoginController();
                 $controller->logout();
                break;
            default:
                var_dump("case default");
                //$controller = new ViewController();
                $loginController = new LoginController();
                /*$controller->body().*/
                return $loginController->body();

        }


    }



}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */