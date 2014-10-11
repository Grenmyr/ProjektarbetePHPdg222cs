<?php
namespace src\view;

use src\view\nav\NavView;

class LoginView {

    private $message;
    private $agent = "";


    public function GetAgent(){
        $this->userData = $_SERVER['HTTP_USER_AGENT'];
        return $this->agent;
    }

    // Return true if submit.
    public function userSubmit(){
        if  (isset($_POST['submitButton'])){
            return true;
        }
        return false;
    }

    Public function wantCookie() {
        if(isset($_POST["LoginView::Checked"])){
            return true;
        }
        return false;
    }

    public  function logoutMSG(){
        $this->message = "Du har nu loggat ut.";
    }


    public function FailedMSG($username,$password) {
        if($username===""){
        $this->message = 'Användarnamn saknas: ';
        }
        else if($password === ""){
            $this->message .= "Lösenord saknas";
        }
        else{
            $this->message .= "Felaktigt användarnamn och/eller lösenord.";
        }
    }
    public function failedCookieMSG(){
        $this->message = "Felaktig information i cookie.";
    }
    public function registrationMSG(){
        $this->message = "Registrering av ny användare lyckades.";
    }

    public function GetUsername(){
        return (isset($_POST["username"])) ? $_POST["username"] : '';
    }

    Public function GetPassword(){
        return (isset($_POST["password"])) ? $_POST["password"] : '';
    }

    /**
     * @return string
     */
    public function show (){
        $username = $this->GetUsername();
        $password = $this->GetPassword();
        return "
            <h1>Laborationskod dg222cs</h1>
            <h2>Ej Inloggad</h2>
            <form enctype=multipart/form-data method=post action='" . NavView::$loginView . "'>
                   <a href='" . NavView::$registerView . "'>Registrera ny användare</a>
                <fieldset>
                    <legend>
                        Login - Skriv in användarnamn och lösenord
                    </legend>
                    <p>$this->message<p>
                    <label>
                    Användarnamn:
                    </label>
                    <input type='text' size='20' name='username' value='$username'>
                    <label> Lösenord </label>
                    <input type='password' size='20' name='password' value='$password'>
                    <label>Håll mig inloggad</label>
                    <input type='checkbox' name='LoginView::Checked' id='AutologinID'/>
                    <input type='submit' value='Logga in' name='submitButton'>
                </fieldset>
            </form>
        ";
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-06
 * Time: 13:05
 */ 