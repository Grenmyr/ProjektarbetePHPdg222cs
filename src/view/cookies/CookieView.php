<?php
class CookieView {
    private $cookieName = "uniqueString";
    private $cookieTime;

    public function save($unique) {
        $this->cookieTime = time()+6000;
        setcookie( $this->cookieName, $unique, $this->cookieTime);
        return $this->cookieTime;
    }
    public function cookieExist() {
        if(isset($_COOKIE[$this->cookieName])){
            return true;
        }
        return false;
    }
    public function load(){
        $ret = $_COOKIE[$this->cookieName];
        return $ret;
    }
    public function deleteCookie(){
        setcookie( $this->cookieName, NULL, time()-1);
    }
}
/**
 * Created by PhpStorm..
 * User: dav
 * Date: 2014-09-13
 * Time: 16:08
 */
