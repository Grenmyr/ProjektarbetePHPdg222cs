<?php
namespace controller;
use CookieView;
use model\repository\UMLRepository;
use model\repository\UserRepository;
use model\SessionModel;
use model\UmlModel;
use model\UmlToCodeModel;
use src\exceptions\umltocodecontrollerexceptions\DeleteProjextException;
use src\exceptions\umltocodecontrollerexceptions\NoHTMLAllowedException;
use src\exceptions\umltocodecontrollerexceptions\ProjectExistException;
use src\exceptions\umltocodecontrollerexceptions\RegexSaveNameException;
use src\exceptions\umltocodecontrollerexceptions\RegexUmlStringException;
use src\exceptions\umltocodecontrollerexceptions\SaveNameLengthException;
use src\exceptions\umltocodecontrollerexceptions\SaveNameMaxLengthException;
use src\exceptions\umltocodecontrollerexceptions\UmlLengthException;
use src\exceptions\umltocodecontrollerexceptions\UmlMaxLengthException;
use src\exceptions\umltocodecontrollerexceptions\UmlStringToShortException;
use src\view\GuestView;
use src\view\MemberView;
use src\view\subview\ProdjectsView;
use src\view\subview\SaveToZipView;


class UmlToCodeController {
    private $guestView;
    private $umlRepository;
    private $interpretModel;
    private $memberView;
    private $umlToCodeModel;
    /**
     * Construct Creating Associations.
     */
    public function __construct($interpretModel){
        $this->interpretModel = $interpretModel;
        $this->guestView = new GuestView($interpretModel);
        $this->umlRepository = new UMLRepository();
        $this->memberView = new MemberView($interpretModel);

        $this->umlToCodeModel = new UmlToCodeModel();
    }


    public function showGuestView(){

        $this->guestView->exampleSubmitUml();
        try{
        if($this->guestView->userSubmitUml()){

            $this->guestView->handleInput();
        }
        }
        catch(UmlStringToShortException $e){
            $this->guestView->umlToShortMSG();
        }
        catch(NoHTMLAllowedException $e){
            $this->guestView->noHTMLMSG();
        }



        return $this->guestView->show() ;
    }


    /**
     * @param SessionModel $sessionModel
     * @return string
     */
    public function showMemberView($sessionModel){
        // Get agent from session and set to view.
        $this->memberView->SetUser($sessionModel->GetUser());

        // If user created cookie,logged in or registered, show messages.
        $cookieView = New CookieView();
        if($cookieView->cookieExist()){
            $this->memberView->cookieWelcome();
        }
        $this->memberView->loginWelcome();
        $this->memberView->registerWelcome();

        $this->memberView->exampleSubmitUml();
        try{
        if($this->memberView->userSubmitUml()){
            $this->memberView->handleInput();
        }
        else if($this->memberView->userSaveToServer()){
                $this->saveUML();
        }
        else if($umlPost = $this->memberView->userSaveToZip()){
            $classArray = $this->interpretModel->validate($umlPost);
            if( $classArray === null){
                $this->guestView->toLongInputMSG();
            }
            else{
                New SaveToZipView($classArray);
            }
        }
        }
        catch(UmlStringToShortException $e){
            $this->memberView->umlToShortMSG();
        }
        catch(NoHTMLAllowedException $e){
            $this->memberView->noHTMLMSG();
        }
        return $this->memberView->showMemberContents();
    }
    public function saveUML(){
        $saveName = $this->memberView->GetSaveName();
        $umlString = $this->memberView->GetTextInput();
        $username = $this->memberView->GetUser();
        try{
        $this->umlToCodeModel->CreateUML($saveName,$umlString,$username);
            $this->memberView->SaveMSG($saveName);
        }
        catch(RegexSaveNameException $e){
            $savename  = $e->getMessage();
            $this->memberView->badCharSaveNameValueMSG($savename);
        }
        catch(RegexUmlStringException $e){
            $savename  = $e->getMessage();
            $this->memberView->badCharInputValueMSG($savename);
        }
        catch(SaveNameLengthException $e){
            $this->memberView->saveNameLengthMSG();
        }
        catch(SaveNameMaxLengthException $e){
            $this->memberView->saveNameMaxLengthMSG();
        }
        catch(UmlLengthException $e){
            $this->memberView->umlLengthExceptionMSG();
        }
        catch(UmlMaxLengthException $e){
            $this->memberView->UmlMaxLengthExceptionMSG();
        }
        catch(ProjectExistException $e){
            $this->memberView->projectExistMSG();
        }
    }

    // Generate list of server stored projects by that user..
    public function projectsView($sessionModel)
    {
        $projectView = New ProdjectsView();
        $userName = $sessionModel->GetUser();
        $userRepository = New UserRepository();
        $dbUser = $userRepository->getUserByUsername($userName);
        $umlArray =$this->umlRepository->getProjectsByUserID($dbUser->GetUserID());


        if($umlArray === null){
            $this->memberView->NoUmlExistMSG();
            return null;
        }

        return $projectView->Show($umlArray);
    }

    public  function selectProject($sessionModel){
        $projectView = New ProdjectsView();
        $dbUml = null;
        // Get projectname from view.
        if($projectName = $projectView->GetProjectName()){
            $uml = New UmlModel();
            $uml->SetSaveName($projectName);

            // Get userID from UserTable and then populate to UML object.
            $username = $sessionModel->GetUser();
            $userRepository = new UserRepository();
            $user = $userRepository->getUserByUsername($username);
            $uml->SetUserID($user->GetUserID());

            // Get project by UserID and projectName selected project
            $dbUml = $this->umlRepository->getProject($uml);
        }
        if($dbUml === null){
            $this->memberView->projectNotExistMSG();
        }
        else{
            $this->memberView->SetInputValue($dbUml->GetUmlString());
            $this->memberView->SetSaveNameValue($dbUml->GetSaveName());
            $this->memberView->loadedProjectMSG();
        }
    }

    public function deleteUmlProject($sessionModel){
        $projectView = New ProdjectsView();
        // Get projectname from view.
        if($projectName =$projectView->GetProjectName() ){
            try{
                $uml = New UmlModel();
                $uml->SetSaveName($projectName);

                // Get userID from UserTable and then populate to UML object.
                $username = $sessionModel->GetUser();
                $userRepository = new UserRepository();
                $user = $userRepository->getUserByUsername($username);
                $uml->SetUserID($user->GetUserID());

                // Delete project by UserID and projectName.
                $this->umlRepository->deleteProject($uml);
                $this->memberView->deleteMSG($uml->GetSaveName());
                }
                catch(DeleteProjextException $e){
                    $this->memberView->errorDeleteMSG();
                }
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