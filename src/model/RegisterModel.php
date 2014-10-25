<?php

namespace model;


use src\Exception\RegexException;
use src\Exception\RegisterException;
use src\Exception\RegisterPasswordMaxLengthException;
use src\Exception\RegisterUsernameLengthException;
use src\Exception\RegisterUsernameMaxLengthException;


/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:07
 */

class RegisterModel {
    private $username;

    const  REGEX = '/[^a-z0-9\-]+/i';

    const USERNAMEMINLENGTH = 3;
    const USERNAMEMAXLENGTH = 20;
    const PASSWORDMINLENGTH = 6;
    const PASSWORDMAXLENGTH = 20;

    public function SetUsername($userName){
        $this->sanitizeName($userName);
        if(strlen($userName) < self::USERNAMEMINLENGTH){
                throw new RegisterUsernameLengthException();
        }
        else if(strlen($userName) > self::USERNAMEMAXLENGTH){
            throw new RegisterUsernameMaxLengthException();
        }
        else{
            $this->username = $userName;
        }
    }
    public function sanitizeName($string){
        if(!preg_match(self::REGEX, "$string" )){
            return true;
        }
        else{
            $string = preg_replace(self::REGEX, '', $string);
            throw new RegexException($string);
        }
    }
    public function hashPassword($password){
        if((strlen($password) < self::PASSWORDMINLENGTH) ) {
            throw new RegisterException;
        }
        elseif((strlen($password) > self::PASSWORDMAXLENGTH) ) {
            throw new RegisterPasswordMaxLengthException;
        }
        return  password_hash($password,PASSWORD_BCRYPT);
    }
} 