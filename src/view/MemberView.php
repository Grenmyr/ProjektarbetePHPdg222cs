<?php


namespace src\view;


use src\view\nav\NavView;

class MemberView  {
    private $username;
    private $message;

    private static $saveUmlButton = "saveumlbutton";
    private static $saveName = "savename";


    public function userLoggedOut(){
        if(NavView::getAction() == NavView::$logoutView){
            return true;
        }
        return false;
    }
    public function userSubmit(){
        return(isset($_POST[self::$saveUmlButton]));
    }
    public function GetSaveName(){
        if(isset($_POST[self::$saveName])){
            return($_POST[self::$saveName]);
        }
        return false;
    }

    public function cookieSuccessMSG() {
        $this->message = "Inloggningen lyckades och vi kommer ihåg dig i 7 dagar..";
    }

    public function presentUser($userName){
        $this->username = $userName;
    }


    public function showMemberContent (){

        return "
            <h1>Projekt UML->Code</h1>
            <h2>$this->username är inloggad.</h2>
            <p>$this->message<p>
             <form  method=post action='?action=" . NavView::$umlSubmit . "'>
    <fieldset>
        <legend>
            Type name to save Uml->Code project.
        </legend>
        <label></label>
         <input type='text' size='20'  name=" .self::$saveName."'>
        <input type='submit' value='Save Uml->Code model' name=" .self::$saveUmlButton."'>
    </fieldset>
    </form>
                   <a href='?action=" . NavView::$logoutView . "'>Logga ut</a>

        ";
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:40
 */