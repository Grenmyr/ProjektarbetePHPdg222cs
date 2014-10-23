<?php
namespace src\view;

use src\view\nav\NavView;

class RegisterView {
    private $message =[];
    private $userName;
    private static $usrName = 'username';
    private static $pWord1 = 'password1';
    private static $pWord2 = 'password2';
    private static $registerButton = 'registerButton';

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
        if(isset($_POST[self::$usrName])){
            return($_POST[self::$usrName]);
        }
        return false;
    }
    Public function GetPassword1(){
        if(isset($_POST[self::$pWord1])){
            return($_POST[self::$pWord1]);
        }
        return false;
    }
    Public function GetPassword2(){
        if(isset($_POST[self::$pWord2])){
            return($_POST[self::$pWord2]);
        }
        return false;
    }
    public function SetUsername($username){
        $this->userName = $username;
    }
    public function submit(){
        return(isset($_POST[self::$registerButton]));
    }

    public function show(){
        if (!$this->userName) {
            $this->userName = $this->GetUsername();
        }
        $message = $this->renderMessages();
        $ret ="
        <header>
        <h3>UML->Code : Registrering</h3>
    <a href='?action=" . NavView::$umlSubmit . "'>Till UML->Code</a>

    </header>
         <div class='formcontent' content='Code->UML'>
        <h2>
    Ej Inloggad, Registrerar användare
</h2>
<form enctype=multipart/form-data method=post action='?action=" . NavView::$registerView . "'>

    <fieldset>
        <legend>
            Registrera ny användare -Skriv in användarnamn och lösenord
        </legend>
        <div class='message'> $message </div>
        <label>
        Namn:
        </label>
        <input type='text' size='20' name='".self::$usrName."' value='$this->userName'>
        <label> Lösenord </label>
        <input type='password' size='20' name='".self::$pWord1."' >
        <label> Repetera Lösenord</label>
        <input type='password' size='20' name='".self::$pWord2."' >
        <input type='submit' value='Registrera' name='".self::$registerButton."'>
    </fieldset>
</form>
</div>
        ";
        return $ret;
    }

    public function msgUsernameAndPasswordLength(){
        $this->message[] = "Användarnamn och lösenord måste ha minst 3 respektive sex tecken.";
    }
    public function msgUsernameLength(){
        $this->message[] = "Användarnamnet har för få tecken. Minst 3 tecken.";
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
        $this->message[] = "Användare existerar redan, försök med annat användarnamn.";
    }

    public function msgUsernameMaxLength()
    {
        $this->message[] =  "Användarnamnet har för många tecken. Max 20 tecken.";
    }

    public function msgPasswordMaxLength()
    {
        $this->message[] = "Lösenorden är för långa, max 20 tecken.";
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 16:06
 */