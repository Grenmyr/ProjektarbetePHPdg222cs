<?php


use src\Exception\RegexException;

class UmlToCodeModel {
    //TODO PERhaps just use registermodel, not sure
    const  REGEX = '/[^a-z0-9\-\+\|\[\]\(\)]+/i';
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

    public function validate($saveName,$umlString,$username){
        $uml = new UML();
        $uml->SetSaveName($saveName);
        $uml->SetUmlString($umlString);
        $uml->SetUsername($username);
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-14
 * Time: 16:25
 */