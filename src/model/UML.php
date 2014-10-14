<?php


use src\exceptions\umltocodecontrollerexceptions\RegexSaveNameException;
use src\exceptions\umltocodecontrollerexceptions\RegexUmlStringException;

class UML {
    private $saveName;
    private $umlString;
    private $userID;
    private $username;

    const  REGEX = '/[^a-z0-9\-\+\|\[\]\(\)]+/i';


    public function SetUserID($userID){

        $this->userID = $userID;

    }
    public function SetUsername($username){

        $this->username = $username;
    }
    public function SetSaveName($saveName){

        if(!preg_match(self::REGEX, "$saveName" )){
            $this->saveName = $saveName;
        }
        else{
            $saveName = preg_replace(self::REGEX, '', $saveName);
            var_dump($saveName);
            throw new RegexSaveNameException($saveName);
        }
    }
    public function SetUmlString($umlString){
        if(!preg_match(self::REGEX, "$umlString" )){
        $this->umlString = $umlString;
        }
        else{
                $umlString = preg_replace(self::REGEX, '', $umlString);
                throw new RegexUmlStringException($umlString);
            }
    }

    public function GetUsername(){
       return  $this->username;
    }
    public function GetUmlString(){
        return  $this->umlString;
    }
    public function GetSaveName(){
        return  $this->saveName;
    }





}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-14
 * Time: 14:35
 */