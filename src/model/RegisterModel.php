<?php

namespace model;


use src\Exception\RegexException;
use src\Exception\RegisterException;
use src\Exception\RegisterUsernameAndPasswordNullException;
use src\Exception\RegisterUsernameLengthException;


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

    public function SetUsername($userName){
        $this->sanitizeName($userName);
        if(strlen($userName) < self::USERNAMEMINLENGTH){
            if($this->validCredentials()){
                throw new RegisterUsernameLengthException($userName);
            }
                throw new RegisterUsernameAndPasswordNullException("Either Password is null");
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
            throw new RegexException($userName);
        }
    }
    public function hashPassword($password){
        if((strlen($password) < self::PASSWORDMINLENGTH) ) {
            throw new RegisterException;
        }
        return  password_hash($password,PASSWORD_BCRYPT);
    }
    public function validCredentials(){
        return ($this->password !== null && $this->username !== null);
    }


} 