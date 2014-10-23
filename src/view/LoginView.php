<?php
namespace src\view;

use src\view\nav\NavView;

class LoginView {

    private $message;
    private $agent = "";

    private static $loginButton = 'loginButton';
    private static $checked = 'checked';
    private static $userName = 'username';
    private static $password = 'pass';


    public function GetAgent(){
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        return $this->agent;
    }

    // Return true if submit.
    public function userSubmit(){
        if  (isset($_POST[self::$loginButton])){
            return true;
        }
        return false;
    }
    Public function wantCookie() {
        if(isset($_POST[self::$checked])){
            return true;
        }
        return false;
    }

    public function FailedMSG($username,$password) {
        if($username===""){
        $this->message = 'Användarnamn saknas. ';
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

    public function GetUsername(){
        return (isset($_POST[self::$userName])) ? $_POST[self::$userName] : '';
    }

    Public function GetPassword(){
        return (isset($_POST[self::$password])) ? $_POST[self::$password] : '';
    }

    /**
     * @return string
     */
    public function show (){
        $username = $this->GetUsername();
        return "
         <div class='formcontent'>

            <form enctype=multipart/form-data method=post action='?action=" . NavView::$login . "' id='loginform' >
                <div class='message'><p>$this->message</p></div>
                <fieldset>
                    <legend>
                        Login - Skriv in användarnamn och lösenord
                    </legend>

                    <label>
                    Användarnamn:
                    </label>
                    <input type='text' size='20' name='".self::$userName."' value='$username'>
                    <label> Lösenord </label>
                    <input type='password' size='20' name='".self::$password."'>
                    <label>Håll mig inloggad</label>
                    <input type='checkbox' name='".self::$checked."' id='AutologinID'/>
                    <input type='submit' value='Logga in' name='".self::$loginButton."'>
                </fieldset>
            </form>
            </div>
        ";
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-06
 * Time: 13:05
 */ 