<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-21
 * Time: 10:36
 */

namespace src\view;

class MasterView {

    /**
     * @var \SweDateView
     */
    private $sweDateView;
    private $memberView;
    private $guestView;
    private $loginView;
    private $projectsView;
    private $registerView;
    private $logoutView;

    public function __construct(){
        $this->sweDateView = new \SweDateView();
    }

    public function SetGuestView($guestView){
        $this->guestView = $guestView;
    }
    public function SetMemberVIew($memberView){
        $this->memberView = $memberView;
    }
    public function SetProjectsView($projectsView){
        $this->projectsView = $projectsView;
    }
    public function SetLoginView($loginView){
        $this->loginView = $loginView;
    }
    public function SetRegisterView($registerView){
        $this->registerView = $registerView;
    }
    public function SetLogoutView($logoutView){
        $this->logoutView = $logoutView;
    }


    public function render(){
        return $this->guestView
        . $this->memberView .$this->projectsView . $this->loginView
        .$this->registerView .$this->logoutView .$this->sweDateView->show();
    }


} 