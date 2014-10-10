<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:06
 */

namespace src\view;


use RegisterModel;
use src\view\nav\NavView;

class RegisterView {


    /**
     * @var RegisterModel
     */
    private $registerModel;

    private $message =[];
    private $userName;
    public function __construct($registerModel){
        $this->registerModel = $registerModel;
    }

    // Return true if user press register button.
    public function IfUserSubmit(){
        if  (isset($_POST['registerButton'])){
            try{
                $this->registerModel->registerUser($this->GetUsername());
            }
            catch(\src\Exception\RegisterException $e){
                $this->message[] = $e->getMessage();
            } catch(\src\Exception\RegexException $e){
                $this->message[] = "Användarnamnet innehåller ogiltiga tecken";
                $this->userName = $e->getMessage();
            }

            if($this->GetPassword1()=== $this->GetPassword2()){
                try{
                    $this->registerModel->registerPassword($this->GetPassword1());
                }
                catch(\src\Exception\RegisterException $e){
                    $this->message[] = $e->getMessage();
                }
            }
            else{
                $this->message[] = " Lösenorden matchar inte";
            }
        }
        return $this->registerModel;
    }

    public function userExists(){
        $this->message[] = "Användarnamnet är redan upptaget.";
    }

    public function renderMessages(){
        $dom = '';
        if(is_array($this->message )){
            foreach ($this->message as $messages){
                $dom .= "<p>$messages</p>";
            }
        }
        return $dom;
    }

    public function GetUsername(){
        if(isset($_POST["username"])){
            return($_POST["username"]);
        }
        return false;
    }
    Public function GetPassword1(){
        if(isset($_POST["password1"])){
            return($_POST["password1"]);
        }
        return false;
    }
    Public function GetPassword2(){
        if(isset($_POST["password2"])){
            return($_POST["password2"]);
        }
        return false;
    }

    public function show(){
        if (!$this->userName) {
            $this->userName = $this->GetUsername();
        }
        $password1 = $this->GetPassword1();
        $password2 = $this->GetPassword2();
        $message = $this->renderMessages();
        $ret ="<h1>Laborationskod dg222cs</h1>
        <h2>
    Ej Inloggad, Registrerar användare
</h2>
<form enctype=multipart/form-data method=post action='?action=" . NavView::$registerView . "'>
    <a href='?action=" . NavView::$guestView . "'>Tillbaka</a>
    <fieldset>
        <legend>
            Registrera ny användare -Skriv in användarnamn och lösenord
        </legend>
        <div> $message </div>
        <label>
        Namn:
        </label>
        <input type='text' size='20' name='username' value='$this->userName'>
        <label> Lösenord </label>
        <input type='password' size='20' name='password1' value='$password1'>
        <label> Repetera Lösenord</label>
        <input type='password' size='20' name='password2' value='$password2'>
        <input type='submit' value='Registrera' name='registerButton'>
    </fieldset>
</form>

        ";
        return $ret;
    }
} 