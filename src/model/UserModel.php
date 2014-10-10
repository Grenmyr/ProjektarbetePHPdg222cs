<?php



class UserModel{
    private $username;
    private $password;
    private $userID;
    private $expire;

    const  REGEX = '/[^a-z0-9\-]+/i';

    const USERNAMEMINLENGTH = 3;
    const PASSWORDMINLENGTH = 6;

    /**
     * @var SessionModel
     */
    private $sessionModel;

    public function __construct() {
        $this->sessionModel = new SessionModel();
    }


    /**
     * @param $uniquekey
     * @param $agent
     * @return bool
     */
    public function cookieLogin($uniquekey,$agent){
        $uniqueRepository = new UniqueRepository();
        $dbUserModel= $uniqueRepository->GetUniqueKey($uniquekey);
        if ($dbUserModel) {
            // If time has not expired on uniquekey in db.
            if($dbUserModel->GetExpire() > time()){
                $this->sessionModel->SetValidSession($agent);
                //Set UserID on this dbUserModel by using dbUserModel own Getter.
                $this->SetUserID($dbUserModel->GetUserID());
                return true;
            }
        }
            return false;
    }

    /**
     * @param $userID
     * @return null
     */
    public function getUsernameByUserID($userID){
        $userRepository = new UserRepository();
        $username = $userRepository->getUsernameByUserID($userID);
        return $username;
    }

    public function logIn( $username, $password,$agent){
        $userRepository = new UserRepository();
        $dbUserModel =$userRepository->getUserByUsername($username);
        //if not dbUserModel is not null and verify match.
        if ($dbUserModel && $dbUserModel->verifyPassword($password)) {
            $this->sessionModel->SetValidSession($agent);
            $this->SetUserID($dbUserModel->GetUserID());
            return true;
        }
        return false;
    }
    private function verifyPassword($password){
        return password_verify($password, $this->password);
    }

    public function registerPassword($password){
        if((strlen($password) < self::PASSWORDMINLENGTH) ) {
            throw new \src\Exception\RegisterException("Lösenorden har för få tecken.Minst 6 tecken");
        }
        $this->password = password_hash($password,PASSWORD_BCRYPT);
    }

    public function logOut(){
        $this->sessionModel->UnsetSession();
    }
    public function createUniqueKey(){
        $uniqueKey = uniqid();
        return $uniqueKey;
    }

    public function IsAuthenticated($agent){
        return $this->sessionModel->CheckValidSession($agent);
    }

    public function isValid(){
        return ($this->password !== null && $this->username !== null);
    }
    // IF regex match, return true, else sanitize name and throw RegexException.
    public function sanitizeName($userName){
        //http://stackoverflow.com/questions/3022185/regular-expression-sanitize-php
       if(!preg_match(self::REGEX, "$userName" )){
           return true;
       }
       else{
           $userName = preg_replace(self::REGEX, '', $userName);
           throw new \src\Exception\RegexException($userName);
       }
    }

    public function checkValidName($userName){
        return(preg_match(self::REGEX, "$userName" ));
    }

    public function registerUser($userName){
        $this->sanitizeName($userName);
        if(strlen($userName) < self::USERNAMEMINLENGTH){
        throw new \src\Exception\RegisterException("Användarnamnet har för få tecken. Minst 3 tecken");
        }
        else{
            $this->username = $userName;
        }
    }

    public function SetHash($hash){
        $this->password = $hash;
    }
    public function SetUserID($userID){
        $this->userID = $userID;
    }
    public function SetExpire($expire){
        $this->expire = $expire;
    }
    public function SetUsername($username){
        $this->username = $username;
    }

    public function GetUsername(){
        return $this->username;
    }
    public function GetPassword(){
        return $this->password;
    }
    public function GetUserID(){
        return $this->userID;
    }
    public function GetExpire(){
        return $this->expire;
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-09
 * Time: 13:50
 */ 