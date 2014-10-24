<?php
namespace model;
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:08
 */

class User {
    private $username;
    private $password;
    private $userID;
    private $expire;

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


    public function SetHash($hash){
        $this->password = $hash;
    }
    public function SetUserID($userID){
        $this->userID = $userID;
    }
    public function SetUsername($username){
        $this->username = $username;
    }
    public function SetPassword($password){
        $this->password = $password;
    }
    public function SetExpire($expire){
        $this->expire = $expire;
    }
} 