<?php

namespace controller;

use model\SessionModel;
use src\view\nav\NavView;
use SweDateView;

class MasterController {

    public function render(){
        $sessionModel = New SessionModel();
        $loginController = new LoginController($sessionModel);
        $isLoggedIn = $loginController->checkLogin();
        $umlToCodeController = new UmlToCodeController();
        $sweDateView = new SweDateView();

        switch(NavView::getAction()){
            case NavView::$umlSubmit;
                if($isLoggedIn){
                    return $umlToCodeController->showMemberView($sessionModel) .$sweDateView->show();
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
            case NavView::$umlGetLists;
                var_dump("case umlGetLists");
                if($isLoggedIn){
                    return $umlToCodeController->showMemberView($sessionModel) . $umlToCodeController->projectsView() .$sweDateView->show()  ;
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
            case NavView::$showProject;
               var_dump("case showproject");
                if($isLoggedIn){
                    return $umlToCodeController->getUmlProject() . $umlToCodeController->showMemberView($sessionModel) .$sweDateView->show() ;
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
            case NavView::$deleteProject;
                var_dump("case deleteproject");
                if($isLoggedIn){
                    return $umlToCodeController->deleteUmlProject().  $umlToCodeController->showMemberView($sessionModel) .$sweDateView->show() ;
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
            case NavView::$saveToDisk;
                var_dump("case savetodisk");
                if($isLoggedIn){
                    return $umlToCodeController->deleteUmlProject().  $umlToCodeController->showMemberView($sessionModel) .$sweDateView->show()  ;
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
            case NavView::$registerView;
                var_dump("case registerview");
                $registerController = new RegisterController();
                return $registerController->body() .$sweDateView->show();
            case NavView::$login;
               var_dump("case login");
                return    $umlToCodeController->showGuestView() . $loginController->login() .$sweDateView->show();
            case NavView::$logoutView;
                var_dump("case logoutview");
                $loginController->logout();
                break;
            default:
                var_dump("case default");
                if($isLoggedIn){
                    return $umlToCodeController->showMemberView($sessionModel) .$sweDateView->show();
                }
                    return  $umlToCodeController->showGuestView() .$loginController->login() .$sweDateView->show();
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