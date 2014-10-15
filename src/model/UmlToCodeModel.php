<?php


use src\Exception\RegexException;

class UmlToCodeModel {
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