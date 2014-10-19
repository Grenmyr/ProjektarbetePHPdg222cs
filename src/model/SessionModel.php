<?php
namespace model;
class SessionModel {
   // Set a new session.
   public function __construct(){
       if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
       }
   }
    public function SetUser($username){
        $_SESSION["userName"]=$username;
    }
    public function GetUser(){
        if(isset($_SESSION["userName"])){
                return $_SESSION['userName'];
        }
        return false;
    }

    /*
     * This check if a valid Session, and a valid agent which it compare to stored agent in session.
     * Then it return true to controller.
     */
    public  function CheckValidSession($agent){
        if(isset($_SESSION["validSession"])&& isset($_SESSION['agent'])){
            if($_SESSION['agent']=== $agent )
            return true;
        }
        return false;
    }

    // used to set session and and agent(string) into session.
    public function SetValidSession($agent){
        $_SESSION["validSession"]=true;
        $_SESSION["agent"] = $agent;
    }
    // Remove session.
    public function logout(){
        unset($_SESSION['validSession']);
    }

   // Not implemented in application
   public function SetUMLText($string){
       $_SESSION["model"]= $string;
   }
    // Not implemented in application
    public function GetUMLText(){
        return $_SESSION["model"];
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-10
 * Time: 18:01
*/