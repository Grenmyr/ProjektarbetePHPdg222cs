<?php
namespace model;

use model\repository\UMLRepository;

class UmlToCodeModel {
    //TODO More code here if i add update functionality? Like Update atm i have CRD :-)
    public function CreateUML($saveName,$umlString,$username){

        $uml = new Uml();
        $uml->SetSaveName($saveName);
        $uml->SetUmlString($umlString);
        $uml->SetUsername($username);
        $umlRepository = New UMLRepository();
        $umlRepository->add($uml);
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-14
 * Time: 16:25
 */