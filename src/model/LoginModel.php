<?php
namespace model;




use model\repository\CookieRepository;
use model\repository\UserRepository;

class LoginModel {
    private $sessionModel;
    private $userID;

    public function __construct() {
        $this->sessionModel = new SessionModel();
    }

    // Get check db by username and match input from view with db hashed password. If match user is logged in.
    public function logIn( $username, $password,$agent){
        $userRepository = new UserRepository();
        $dbUser =$userRepository->getUserByUsername($username);
        //if not dbUserModel is not null and verify match.
        if($dbUser === null){
            return false;
        }
        if ($this->verifyPassword($password,$dbUser->GetPassword()) ) {
            $this->sessionModel->SetValidSession($agent);
            $this->SetUserID($dbUser->GetUserID());
            return true;
        }
        return false;
    }
    private function verifyPassword($password,$dbPassword){
        return password_verify($password, $dbPassword);
    }

    public function cookieLogin($uniquekey,$agent){
        $cookieRepository = new CookieRepository();
        $dbUser= $cookieRepository->GetUniqueKey($uniquekey);
        if ($dbUser) {
            // If time has not expired on uniquekey in db.
            if($dbUser->GetExpire() > time()){
                $this->sessionModel->SetValidSession($agent);
                //Set UserID on this dbUserModel by using dbUserModel own Getter.
                $this->userID = $dbUser->GetUserID();
                return true;
            }
        }
        return false;
    }
    public function createUniqueKey(){
        $uniqueKey = uniqid();
        return $uniqueKey;
    }

    public function getUsernameByUserID($userID){
        $userRepository = new UserRepository();
        $username = $userRepository->getUsernameByUserID($userID);
        return $username;
    }

    public function GetUserID(){
        return $this->userID;
    }
    private function SetUserID($userID){
        $this->userID = $userID;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:19
 */