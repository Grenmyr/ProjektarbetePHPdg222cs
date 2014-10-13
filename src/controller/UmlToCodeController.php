<?php
namespace controller;
use model\InterpretModel;
use model\UMLRepository;
use src\view\GuestView;
use src\view\MemberView;


class UmlToCodeController {
    private $guestView;
    private $umlRepository;
    private $interpretModel;
    private $memberView;


    /**
     * Construct Creating Associations.
     */
    public function __construct(){
        $this->interpretModel = new InterpretModel();
        $this->guestView = new GuestView();
        $this->umlRepository = new UMLRepository();
        $this->memberView = new MemberView();
    }

    /*
     * Function that handle user Input.
     */
    public function input(){

        if($this->guestView->userSubmit()){
            $this->guestView->handleInput();
        }

        if($this->memberView->userSubmit()){
            $saveName =$this->memberView->GetSaveName();
            var_dump($saveName);
        }
    }
    /*
     * Return GuestView Dom.
     */
    public function body(){
        $this->input();
        return $this->guestView->show() ;
    }
    public function headContent(){
        //Ask my Logincontroller for variable that containts headcontent depending on on registered or not.
    }
    public function subView(){
        // Ask my LoginController for variable that contains subview depending on registered or not.
    }


}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:51
 * Controller to show different views depending if user is logged in or not.
 */