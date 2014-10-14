<?php

namespace controller;

use model\InterpretModel;
use SessionModel;
use src\view\nav\NavView;

class MasterController {

    public function render(){
        $sessionModel = New SessionModel();
        $loginController = new LoginController($sessionModel);

        switch(NavView::getAction()){
            case NavView::$umlSubmit;
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->showMemberView($sessionModel);
                }
                else
                {
                    return  $umlToCodeController->showGuestView();
                }
            case NavView::$umlSave;
                var_dump("case umlSave");
                $umlToCodeController = new UmlToCodeController();
                $umlToCodeController->saveUML();
                break;

            case NavView::$registerView;
                var_dump("case registerview");
                $registerController = new RegisterController();
                return $registerController->body();
            case NavView::$login;
                var_dump("case login");
                return $loginController->login();
            case NavView::$logoutView;
                var_dump("case logoutview");
                $loginController->logout();
                break;
            default:
                var_dump("case default");
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->showMemberView($sessionModel);
                }
                else
                {
                    return  $umlToCodeController->showGuestView();
                }
        }

        return "error";
    }



}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */