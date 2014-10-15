<?php


namespace objectModel;;

class VariableModel {
    private  $publicRegex = '/\+/';

    private $private;
    private $name;
    //TODO implement code for type;
    private $type;

    public function __construct($name){

        if(preg_match($this->publicRegex,$name)){
            $this->name = str_replace('+','',$name);
            $this->private = false;
        }
        else{
            $this->private = true;
            $this->name = $name;
        }
    }
    public function GetPrivate(){
        return $this->private;
    }
    public function GetName(){
        return $this->name;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-07
 * Time: 22:15
 */