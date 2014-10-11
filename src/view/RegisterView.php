<?php
namespace src\view;

use src\view\nav\NavView;

class RegisterView {
    private $message =[];
    private $userName;

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
    public function SetUsername($username){
        $this->userName = $username;
    }
    public function submit(){
        return(isset($_POST['registerButton']));
    }

    public function show(){
        if (!$this->userName) {
            $this->userName = $this->GetUsername();
        }
        $message = $this->renderMessages();
        $ret ="<h1>Laborationskod dg222cs</h1>
        <h2>
    Ej Inloggad, Registrerar användare
</h2>
<form enctype=multipart/form-data method=post action='?action=" . NavView::$registerView . "'>
    <a href='?action=" . NavView::$guestView . "'>Till UML->Code</a>
    <a href='?action=" . NavView::$loginView . "'>Logga in.</a>
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
        <input type='password' size='20' name='password1' >
        <label> Repetera Lösenord</label>
        <input type='password' size='20' name='password2' >
        <input type='submit' value='Registrera' name='registerButton'>
    </fieldset>
</form>

        ";
        return $ret;
    }

    public function msgUsernameAndPasswordLength(){
        $this->message[] = "Användarnamn och lösenord måste ha minst 3 respektive sex tecken.";
    }
    public function msgUsernameLength($name){
        $this->message[] = "Användarnamnet  $name  har för få tecken. Minst 3 tecken";
    }
    public function msgUsernameWrongChar($name){
        $this->message[] = " Användarnamnet $name innehöll tidigare ogiltiga tecken, dom är nu borttagna.";
    }
    public function msgPasswordNotSame(){
        $this->message[] = "Lösenorden måste vara identiska och minst 6 tecken.";
    }
    public function msgPasswordLength(){
        $this->message[] = "Lösenorden är för korta, minst 6 tecken.";
    }
    public function msgUserExist(){
        $this->message[] = "Användare existerar redan, försök med annat användarnamn..";
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:06
 */