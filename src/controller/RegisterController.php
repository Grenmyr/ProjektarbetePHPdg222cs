<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:05
 */

namespace controller;


use CookieView;
use model\RegisterModel;
use model\repository\UserRepository;
use model\SessionModel;
use model\User;
use src\Exception\DbUserExistException;
use src\Exception\RegexException;
use src\Exception\RegisterException;
use src\Exception\RegisterUsernameAndPasswordNullException;
use src\Exception\RegisterUsernameLengthException;
use src\view\LoginView;
use src\view\nav\NavView;
use src\view\RegisterView;
use SweDateView;

class RegisterController {
    /**
     * @var RegisterView
     */
    private $registerView;
    /**
     * @var SweDateView
     */
    private $sweDateView;

    /**
     * @var RegisterModel
     */
    private $registerModel;


    public function __construct(){
        $this->registerModel = new RegisterModel();
        $this->registerView = new RegisterView( $this->registerModel);
        $this->sweDateView = new SweDateView();
    }

    public function body(){
        if($this->registerView->submit()){
            $this->onSubmit();
        }
        return $this->registerView->show() . $this->sweDateView->show();
    }
    private function onSubmit(){
        $username = $this->registerView->GetUsername();
        $password1 = $this->registerView->GetPassword1();
        $password2 = $this->registerView->GetPassword2();
        try{
            $user = new User();

            if($password1 === $password2 ){
            $this->registerModel->SetUsername($username);
            $hashedPassword = $this->registerModel->hashPassword($password1);
            $user->SetPassword($hashedPassword);
            }
            else{
                $this->registerView->msgPasswordNotSame();
                return;
            }
            $user->SetUsername($username);

            $userRepository =new UserRepository();
            $userRepository->add($user);

            $loginView = new LoginView();
            $agent = $loginView->GetAgent();

            $sessionModel = new SessionModel();
            $sessionModel->SetValidSession($agent);
            $sessionModel->SetUser($username);
            NavView::redirectToUMLRegisterMSG($username);
        }
        catch(RegisterUsernameAndPasswordNullException $e){
            $this->registerView->msgUsernameAndPasswordLength();
        }
        catch(RegisterUsernameLengthException $e){
            $name = $e->getMessage();
            $this->registerView->msgUsernameLength($name);
        }
        catch(RegexException $e){
            $name  = $e->getMessage();
            $this->registerView->SetUsername($name);
            $this->registerView->msgUsernameWrongChar($name);
        }
        catch(RegisterException $e){
            $this->registerView->msgPasswordLength();
        }
        catch(DbUserExistException $e){
            $this->registerView->msgUserExist();
        }

    }
} 