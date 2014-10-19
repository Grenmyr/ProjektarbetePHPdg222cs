<?php

namespace model;


use src\Exception\RegexException;
use src\Exception\RegisterException;
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
                throw new RegisterUsernameLengthException();
        }
        else{
            $this->username = $userName;
        }
    }
    public function sanitizeName($string){
        //http://stackoverflow.com/questions/3022185/regular-expression-sanitize-php
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
        return  password_hash($password,PASSWORD_BCRYPT);
    }
} 