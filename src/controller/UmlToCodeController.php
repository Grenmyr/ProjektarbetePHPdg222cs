<?php
namespace controller;
use model\InterpretModel;
use model\repository\UMLRepository;
use model\repository\UserRepository;
use model\SessionModel;
use model\UmlToCodeModel;
use src\exceptions\umltocodecontrollerexceptions\RegexSaveNameException;
use src\exceptions\umltocodecontrollerexceptions\RegexUmlStringException;
use src\exceptions\umltocodecontrollerexceptions\SaveNameLengthException;
use src\exceptions\umltocodecontrollerexceptions\UmlLengthException;
use src\view\GuestView;
use src\view\MemberView;
use src\view\subview\ProdjectsView;


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

    /**
     * @param SessionModel $sessionModel
     * @return string
     */
    public function showMemberView($sessionModel){
        $this->memberView->SetUser($sessionModel->GetUser());
        $this->memberView->setMessage();


        if($this->memberView->userSubmit()){

            $this->memberView->handleInput();
        }
        if($this->memberView->userPostSave()){
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
            $this->memberView->badCharSaveNameValueMSG($string);
        }
        catch(RegexUmlStringException $e){
            $string  = $e->getMessage();
            $this->memberView->badCharInputValueMSG($string);
        }
        catch(SaveNameLengthException $e){
            $this->memberView->saveNameLengthMSG();
        }
        catch(UmlLengthException $e){
            $this->memberView->umlLengthMSG();
        }
    }

    public function projectsView()
    {
        $projectView = New ProdjectsView();
        $userName = $this->memberView->GetUser();
        $userRepository = New UserRepository();
        $dbUser = $userRepository->getUserByUsername($userName);
        $umlArray =$this->umlRepository->getProjectsByUserID($dbUser->GetUserID());
        return $projectView->Show($umlArray);


    }

    public  function getUmlProject(){
        $projectView = New ProdjectsView();
        $UmlName = $projectView->GetProjectName();
        $userID = $projectView->GetUserID();
        $projectView->Getstuff();
    }


}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:51
 * Controller to show different views depending if user is logged in or not.
 */