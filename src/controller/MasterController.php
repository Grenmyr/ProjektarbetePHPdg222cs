<?php

namespace controller;

use model\InterpretModel;
use model\SessionModel;
use src\view\MasterView;
use src\view\nav\NavView;
use SweDateView;

class MasterController {

    public function render(){
        $sessionModel = New SessionModel();
        $masterView = new MasterView();
        $loginController = new LoginController($sessionModel);
        $isLoggedIn = $loginController->checkLogin();
        $umlToCodeController = new UmlToCodeController(new InterpretModel());

        switch(NavView::getAction()){
            case NavView::$umlSubmit;
                if($isLoggedIn){
                    $masterView->SetMemberVIew($umlToCodeController->showMemberView($sessionModel));
                    break;
                }
                    $masterView->SetGuestView($umlToCodeController->showGuestView());
                    $masterView->SetLoginView($loginController->loginView());
                    break;
            case NavView::$umlGetLists;
                if($isLoggedIn){

                    $masterView->SetProjectsView($umlToCodeController->projectsView($sessionModel));
                    $masterView->SetMemberVIew($umlToCodeController->showMemberView($sessionModel));
                    break;
                }
                    $masterView->SetGuestView($umlToCodeController->showGuestView());
                    $masterView->SetLoginView($loginController->loginView());
                    break;
            case NavView::$showProject;
                if($isLoggedIn){
                    $umlToCodeController->selectProject($sessionModel);
                    $masterView->SetMemberVIew($umlToCodeController->showMemberView($sessionModel));
                    break;
                }
                    $masterView->SetGuestView($umlToCodeController->showGuestView());
                    $masterView->SetLoginView($loginController->loginView());
                    break;
            case NavView::$deleteProject;
                if($isLoggedIn){
                    $umlToCodeController->deleteUmlProject($sessionModel);
                    $masterView->SetMemberVIew($umlToCodeController->showMemberView($sessionModel));
                    break;
                }
                    $masterView->SetGuestView($umlToCodeController->showGuestView());
                    $masterView->SetLoginView($loginController->loginView());
                    break;
            case NavView::$registerView;
                $registerController = new RegisterController();
                $masterView->SetRegisterView($registerController->registerView());
                break;
            case NavView::$login;
                $masterView->SetGuestView($umlToCodeController->showGuestView());
                $masterView->SetLoginView($loginController->loginView());
                break;
            case NavView::$logoutView;
                $loginController->logout();
                break;
            default:
                if($isLoggedIn){
                    $masterView->SetMemberVIew($umlToCodeController->showMemberView($sessionModel));
                    break;
                }
                $masterView->SetGuestView($umlToCodeController->showGuestView());
                $masterView->SetLoginView($loginController->loginView());
                break;
        }
        return $masterView->render();
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */