<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:07
 */

class RegisterModel {
    private $username;
    private $password;

    const  REGEX = '/[^a-z0-9\-]+/i';

    const USERNAMEMINLENGTH = 3;
    const PASSWORDMINLENGTH = 6;

    public function registerUser($userName){
        $this->sanitizeName($userName);
        if(strlen($userName) < self::USERNAMEMINLENGTH){
            throw new \src\Exception\RegisterException("Användarnamnet har för få tecken. Minst 3 tecken");
        }
        else{
            $this->username = $userName;
        }
    }
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
    public function registerPassword($password){
        if((strlen($password) < self::PASSWORDMINLENGTH) ) {
            throw new \src\Exception\RegisterException("Lösenorden har för få tecken.Minst 6 tecken");
        }
        $this->password = password_hash($password,PASSWORD_BCRYPT);
    }
    public function isValid(){
        return ($this->password !== null && $this->username !== null);
    }
} 