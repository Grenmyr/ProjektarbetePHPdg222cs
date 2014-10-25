<?php

namespace controller;

use Exception;
use model\InterpretModel;
use model\SessionModel;
use src\view\MasterView;
use src\view\nav\NavView;

class MasterController {

    // MasterController handle all controllers, and user input.
    // It is dependant on NavView to handle paginating and MasterView to handle render settings of HTML.
    public function render(){
        try{

        $sessionModel = New SessionModel();
        $masterView = new MasterView();

        // Dependency injection of sessionModel to make sure they all user same.
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

        catch(Exception $e){
                header('Location: /' . \Settings::$ROOT_PATH. '/common/error.html');
            return null;
        }
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */