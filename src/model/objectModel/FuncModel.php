<?php


namespace objectModel;

class FuncModel {
    protected  $publicRegex = '/\+/';

    private $private;
    private $name;
    //TODO implement code for returnType
    private $returnType;

    // If function has + in name, its public otherwise private.
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
 * Created by PhpStorm
 * User: dav
 * Date: 2014-10-08
 * Time: 08:17
 */