<?php
namespace controller;
use model\InterpretModel;
use model\UMLRepository;
use src\Exception\RegexException;
use src\exceptions\umltocodecontrollerexceptions\RegexSaveNameException;
use src\exceptions\umltocodecontrollerexceptions\RegexUmlStringException;
use src\view\GuestView;
use src\view\MemberView;
use UML;
use UmlToCodeModel;


class UmlToCodeController {
    private $guestView;
    private $umlRepository;
    private $interpretModel;
    private $memberView;
    private $umlToCodeModel;
    /**
     * Construct Creating Associations.
     */
    public function __construct(){
        $this->interpretModel = new InterpretModel();
        $this->guestView = new GuestView();
        $this->umlRepository = new UMLRepository();
        $this->memberView = new MemberView();

        $this->umlToCodeModel = new UmlToCodeModel();
    }
    public function showGuestView(){
        if($this->guestView->userSubmit()){
            $this->guestView->handleInput();
        }
        return $this->guestView->show() ;
    }


    public function showMemberView($sessionModel){
        $this->memberView->SetUser($sessionModel->GetUser());


        if($this->memberView->userSubmit()){
            $this->memberView->handleInput();
        }
        if($this->memberView->userSubmitSave()){
           $this->saveUML();
        }
        return $this->memberView->showMemberContents();
    }
    public function saveUML(){
        $saveName = $this->memberView->GetSaveName();
        $umlString = $this->memberView->GetTextInput();
        $username = $this->memberView->GetUser();
        try{
        $this->umlToCodeModel->validate($saveName,$umlString,$username);
        }
        catch(RegexSaveNameException $e){
            $string  = $e->getMessage();
            $this->memberView->badCharSaveNameValue($string);
        }
        catch(RegexUmlStringException $e){
            $string  = $e->getMessage();
            $this->memberView->badCharInputValue($string);
        }
    }


}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:51
 * Controller to show different views depending if user is logged in or not.
 */