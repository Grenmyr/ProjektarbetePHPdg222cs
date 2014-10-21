<?php
namespace controller;

use CookieView;
use model\LoginModel;
use model\repository\CookieRepository;
use model\SessionModel;
use src\view\GuestView;
use src\view\LoginView;
use src\view\MemberView;
use src\view\nav\NavView;
use SweDateView;

class LoginController {

    /**
     * @var LoginView
     */
    private $loginView;

    /**
     * @var CookieView
     */
    private $cookieView;

    /**
     * @var SessionModel
     */
    private $sessionModel;

    //private $memberView;

    private $loginModel;


    //private $guestView;


    public  function __construct($sessionModel){

        //$this->memberView = new MemberView();
        $this->loginView = new LoginView();
        //$this->guestView = new GuestView();

        $this->sessionModel = $sessionModel;

        $this->loginModel = new LoginModel();
        $this->cookieView = new CookieView();
    }

    public function logout(){
        $user = $this->sessionModel->GetUser();
        $this->sessionModel->logOut();
        $this->cookieView->deleteCookie();
        NavView::redirectHome($user);
    }
    public function checkLogin(){
        // get client details.
        $agent = $this->loginView->GetAgent();
        $this->cookieLogin($agent);
        if($this->sessionModel->CheckValidSession($agent) ) {
            return true;
        }
        else{
            return false;
        }
    }

    public function cookieLogin($agent){
        //check agent,and if session does not exist. Then check if cookie exist, if exist try log in with cookie.
        if(!$this->sessionModel->CheckValidSession($agent) && $this->cookieView->cookieExist()){
            $cookieString = $this->cookieView->load();
            // check userModel if cookie is a valid cookie, if valid cookie set session with user agent.
            if($this->loginModel->cookieLogin($cookieString,$agent)){
                $userID = $this->loginModel->GetUserID();
                $userName = $this->loginModel->getUsernameByUserID($userID);
                $this->sessionModel->SetUser($userName);
            }
            else{
                $this->loginView->failedCookieMSG();
                $this->cookieView->deleteCookie();
            }
        }
    }


    public function loginView(){
        // If user submit login. Then log in.
        if($this->loginView->userSubmit()){
            // Retrieve username and password string from LoginView from user post.
            $password = $this->loginView->GetPassword();
            $username = $this->loginView->GetUsername();
            $trueAgent = $this->loginView->GetAgent();

            // Check userModel if user can log in.
            if ($this->loginModel->LogIn($username, $password,$trueAgent)) {
                // Create cookie if user clicked select box in login view.
                $this->sessionModel->SetUser($username);
                if($this->loginView->wantCookie()){
                    $this->setCookie();
                    NavView::redirectToUMLMSG($username);
                }
                NavView::redirectToUMLMSG($username);
            }
            else{
                //Present error msg if failed login.
                $this->loginView->FailedMSG($username,$password);
            }
        }
        return   $this->loginView->show();
    }
    public function setCookie(){
        $uniqueString = $this->loginModel->createUniqueKey();
        $cookieTime = $this->cookieView->save($uniqueString);
        $cookieRepository = new CookieRepository();
        $userID = $this->loginModel->GetUserID();
        $cookieRepository->add($uniqueString,$cookieTime,$userID);
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-09
 * Time: 14:14
 */ 