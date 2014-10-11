<?php
namespace controller;
use model\InterpretModel;
use model\UMLRepository;
use src\view\GuestView;

//require_once(__DIR__ . "/../view/GuestView.php");

//require_once(__DIR__ . "/../model/UMLRepository.php");

//require_once(__DIR__ . "/../model/InterpretModel.php");


class ViewController {
    private $guestView;
    private $umlRepository;
    private $interpretModel;


    /**
     * Construct Creating Associations.
     */
    public function __construct(){
        $this->interpretModel = new InterpretModel();
        $this->guestView = new GuestView( $this->interpretModel);
        $this->umlRepository = new UMLRepository();

    }

    /*
     * Function that handle user Input.
     */
    public function input(){
        if($this->guestView->userSubmit()){
            $this->guestView->handleInput();
        }
    }
    /*
     * Return GuestView Dom.
     */
    public function body(){
        $this->input();
        return $this->guestView->show();
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