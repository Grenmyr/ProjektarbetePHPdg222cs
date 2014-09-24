<?php
namespace controller;
use model\UMLRepository;
use view\GuestView;

require_once(__DIR__ . "/../view/GuestView.php");

require_once(__DIR__ . "/../model/UMLRepository.php");


class ViewController {
    private $guestView;
    private $umlRepository;

    /**
     * Construct Creating Associations.
     */
    public function __construct(){
        $this->guestView = new GuestView();
        $this->umlRepository = new UMLRepository();
    }

    /*
     * Function that handle user Input.
     */
    public function input(){
        if($this->guestView->userSubmit()){
            $input = $this->guestView->GetInput();
            $this->umlRepository->add($input);
        }
    }
    /*
     * Return GuestView Dom.
     */
    public function body(){
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