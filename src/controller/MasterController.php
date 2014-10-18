<?php

namespace controller;

use model\SessionModel;
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
                break;
            case NavView::$umlGetLists;
                var_dump("case umlGetLists");
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->showMemberView($sessionModel) . $umlToCodeController->projectsView()   ;
                }
                else
                {
                    return  $umlToCodeController->showGuestView() .$loginController->login();
                }
            case NavView::$showProject;
               var_dump("case showproject");
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->getUmlProject() . $umlToCodeController->showMemberView($sessionModel)  ;
                }
                else
                {
                    return  $umlToCodeController->showGuestView();
                }
            case NavView::$deleteProject;
                var_dump("case deleteproject");
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->deleteUmlProject().  $umlToCodeController->showMemberView($sessionModel)  ;
                }
                else
                {
                    return  $umlToCodeController->showGuestView();
                }
            case NavView::$saveToDisk;
                var_dump("case savetodisk");
                $umlToCodeController = new UmlToCodeController();
                if($loginController->checkLogin()){
                    return $umlToCodeController->deleteUmlProject().  $umlToCodeController->showMemberView($sessionModel)  ;
                }
                else
                {
                    return  $umlToCodeController->showGuestView();
                }
            case NavView::$registerView;
                var_dump("case registerview");
                $registerController = new RegisterController();
                return $registerController->body();
            case NavView::$login;
               var_dump("case login");
                $umlToCodeController = new UmlToCodeController();
                return  $loginController->login() . $umlToCodeController->showGuestView();
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