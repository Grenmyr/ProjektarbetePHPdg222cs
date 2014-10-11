<?php
namespace controller;

use CookieView;
use model\CookieRepository;
use model\LoginModel;
use SessionModel;
use src\view\LoginView;
use src\view\MemberView;
use src\view\nav\NavView;
use SweDateView;
use UserModel;

class LoginController {
    /**
     * @var LoggedInView
     */
    private $loggedInView;
    /**
     * @var LoginView
     */
    private $loginView;
    /**
     * @var SweDateView
     */
    private $sweDateView;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var CookieView
     */
    private $cookieView;

    /**
     * @var SessionModel
     */
    private $sessionModel;

    private $memberView;

    private $loginModel;


    public  function __construct(){
        //$this->loggedInView = new LoggedInView($URLView);
        $this->memberView = new MemberView();
        $this->loginView = new LoginView();
        $this->sweDateView = new SweDateView();

        $this->sessionModel = new SessionModel();
        //$this->userModel = new UserModel();
        $this->loginModel = new LoginModel();
        $this->cookieView = new CookieView();
    }

    public function body(){
        //Get Client agent,and if session does not exist. Then check if cookie exist, if exist try log in with cookie.
        $agent = $this->loginView->GetAgent();
        if(!$this->sessionModel->CheckValidSession($agent) && $this->cookieView->cookieExist()){
            $cookieString = $this->cookieView->load();
            // check userModel if cookie is a valid cookie, if valid cookie set session with user agent.
            if($this->loginModel->cookieLogin($cookieString,$agent)){
                $userID = $this->loginModel->GetUserID();
                $userName = $this->loginModel->getUsernameByUserID($userID);
                $this->sessionModel->SetUser($userName);
                //$this->loggedInView->cookieLoginMSG();
            }
            else{
                $this->loginView->failedCookieMSG();
                $this->cookieView->deleteCookie();
            }
        }

        // If authenticated user, check if user pressed Logout. Then logout and present log out message.
        if($this->sessionModel->CheckValidSession($agent)){
            $this->memberView->presentUser($this->sessionModel->GetUser());
            if($this->memberView->userLoggedOut()){
                $this->sessionModel->logOut();
                $this->cookieView->deleteCookie();
                //$this->loginView->logoutMSG();

                //TODO Redirect to LoginView using Navview from controller?
            }
        }
        else{
            // Else if logged out, check if user submit login. Then log in.
            if($this->loginView->userSubmit()){
                // Retrieve username and password string from LoginView from user post.
                $password = $this->loginView->GetPassword();
                $username = $this->loginView->GetUsername();
                $trueAgent = $this->loginView->GetAgent();

                // Check userModel if user can log in.
                if ($this->loginModel->LogIn($username, $password,$trueAgent)) {
                    $this->sessionModel->SetUser($username);
                    $this->memberView->presentUser($username);

                    // Create cookie if user clicked select box in login view.
                        if($this->loginView->wantCookie()){
                            $uniqueString = $this->loginModel->createUniqueKey();
                            $cookieTime = $this->cookieView->save($uniqueString);
                            $cookieRepository = new CookieRepository();
                            $userID = $this->loginModel->GetUserID();
                            $cookieRepository->add($uniqueString,$cookieTime,$userID);
                            $this->memberView->cookieSuccessMSG();
                        }
                    }
                else{
                    //Present error msg if failed login.
                    $this->loginView->FailedMSG($username,$password);
                }
            }
        }

       // After checking For user input previously, then either show login view or logout view.
        if($this->sessionModel->CheckValidSession($agent) ) {
           return $this->memberView->show()
                  . $this->sweDateView->show();
        }
        else{
            return $this->loginView->show()  . $this->sweDateView->show();
        }
    }
}

/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-09
 * Time: 14:14
 */ 