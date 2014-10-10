<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:05
 */

namespace controller;


use RegisterModel;
use src\view\RegisterView;
use SweDateView;
use UserModel;
use UserRepository;

class RegisterController {
    /**
     * @var RegisterView
     */
    private $registerView;
    /**
     * @var UserModel
     */
    private $userModel;
    /**
     * @var SweDateView
     */
    private $sweDateView;

    /**
     * @var RegisterModel
     */
    private $registerModel;

    public function __construct(){
        //$this->userModel = new UserModel();
        $this->registerModel = new RegisterModel();
        $this->registerView = new RegisterView( $this->registerModel);
        $this->sweDateView = new SweDateView();

        //new UserRepository();
    }
    public function body(){
        $user = $this->registerView->IfUserSubmit();
        $userRepository =new UserRepository();

        if ($user->isValid()) {
            try{
                $userRepository->add($user);
                return null;
            } catch(Exception $e) {
                $this->registerView->userExists();
            }
        }
        return $this->registerView->show() . $this->sweDateView->show();
    }

} 