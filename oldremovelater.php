<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-12
 * Time: 18:29
 */
/*
class oldremovelater {
    public function body(){
        //$this->cookieLogin();
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
            // $this->memberView->presentUser($this->sessionModel->GetUser());
            if($this->memberView->userLoggedOut()){
                $this->logout();
                //$this->sessionModel->logOut();
                //$this->cookieView->deleteCookie();
                //$this->loginView->logoutMSG();


            }
        }
        else{
            /// Else if logged out, check if user submit login. Then log in.
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
            return $this->memberView->showMemberContent() . $this->guestView->show()
            . $this->sweDateView->show();
        }
        else{
            return $this->guestView->show() . $this->loginView->show() . $this->sweDateView->show();
        }
    }
}
*/