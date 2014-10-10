<?php
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
    public function UnsetSession(){
        unset($_SESSION['validSession']);
    }

   // Not implemented in application
   public function SaveMessage($string){
       $_SESSION["message"]= $string;
   }
    // Not implemented in application
    public function GetMessage(){
        $ret = $_SESSION["message"];
        return $ret;
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-10
 * Time: 18:01
*/