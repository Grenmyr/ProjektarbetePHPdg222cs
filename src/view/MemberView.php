<?php


namespace src\view;


use src\view\nav\NavView;

class MemberView {
    private $username;
    private $message;

    public function userLoggedOut(){
        if(NavView::getAction() == NavView::$logoutView){
            return true;
        }
        return false;
    }
    public function cookieSuccessMSG() {
        $this->message = "Inloggningen lyckades och vi kommer ihåg dig i 7 dagar.";
    }

    public function presentUser($userName){
        $this->username = $userName;
    }


    public function show (){

        return "
            <h1>Projekt UML->Code</h1>
            <h2>Välkommen $this->username! Du är inloggad.</h2>
            <p>$this->message<p>
                   <a href='?action=" . NavView::$registerView . "'>Registrera ny användare ta bort sen</a>
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