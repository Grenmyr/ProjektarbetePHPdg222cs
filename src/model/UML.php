<?php
namespace model;

use src\exceptions\umltocodecontrollerexceptions\RegexSaveNameException;
use src\exceptions\umltocodecontrollerexceptions\RegexUmlStringException;
use src\exceptions\umltocodecontrollerexceptions\SaveNameLengthException;
use src\exceptions\umltocodecontrollerexceptions\UmlLengthException;

class UML {
    private $saveName;
    private $umlString;
    private $userID;
    private $username;

    const SAVENAMEMINLENGTH = 2;
    const SAVENAMEMAXLENGTH = 20;
    const UMLSTRINGMINLENGTH = 3;
    const UMLSTRINGMAXLENGTH = 250;
    const  UMLSTRINGREGEX = '/[^a-z0-9\-\+\|\[\]\(\)]+/i';
    const  SAVENAMEREGEX = '/[^a-z0-9\-]+/i';


    public function SetUserID($userID){

        $this->userID = $userID;

    }
    public function SetUsername($username){

        $this->username = $username;
    }
    public function SetSaveName($saveName){

        if(!preg_match(self::SAVENAMEREGEX, "$saveName" )){
            if(strlen($saveName) < self::SAVENAMEMINLENGTH){
                throw new SaveNameLengthException("Savename är för kort, måste vara minst 2 tecken.");
            }
            else if(strlen($saveName) > self::SAVENAMEMAXLENGTH){
                throw new SaveNameLengthException("Savename är för långt, får ej vara mer än 20 tecken.");
            }
            $this->saveName = $saveName;
        }
        else{
            $saveName = preg_replace(self::UMLSTRINGREGEX, '', $saveName);
            throw new RegexSaveNameException($saveName);
        }
    }
    public function SetUmlString($umlString){
        if(!preg_match(self::UMLSTRINGREGEX, "$umlString" )){
            if(strlen($umlString) < self::UMLSTRINGMINLENGTH){
                throw new UmlLengthException("Din UML modell är för kort, måste vara minst 3 tecken.");
            }
            else if(strlen($umlString) > self::UMLSTRINGMAXLENGTH){
                throw new UmlLengthException("Umlmodell är för lång, får ej vara mer än 250 tecken.");
            }
        $this->umlString = $umlString;
        }
        else{
                $umlString = preg_replace(self::UMLSTRINGREGEX, '', $umlString);
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
    public function GetUserID(){
        return  $this->userID;
    }





}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-14
 * Time: 14:35
 */