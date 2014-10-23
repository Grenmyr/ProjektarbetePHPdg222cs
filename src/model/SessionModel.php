<?php
namespace model;
class SessionModel {

    private static $userName = 'userName';
    private static $validSession = 'validSession';
    private static $agent = 'agent';



   // Set a new session.
   public function __construct(){
       if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
       }
   }
    public function SetUser($username){
        $_SESSION[self::$userName]=$username;
    }
    public function GetUser(){
        if(isset($_SESSION[self::$userName])){
                return $_SESSION[self::$userName];
        }
        return false;
    }

    /*
     * This check if a valid Session, and a valid agent which it compare to stored agent in session.
     * Then it return true to controller.
     */
    public  function CheckValidSession($agent){
        if(isset($_SESSION[self::$validSession])&& isset($_SESSION[self::$agent])){
            if($_SESSION[self::$agent]=== $agent )
            return true;
        }
        return false;
    }

    // used to set session and and agent(string) into session.
    public function SetValidSession($agent){
        $_SESSION[self::$validSession]=true;
        $_SESSION[self::$agent] = $agent;
    }
    // Remove session.
    public function logout(){
        unset($_SESSION[self::$validSession]);
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-10
 * Time: 18:01
*/