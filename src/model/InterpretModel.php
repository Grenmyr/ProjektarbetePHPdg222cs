<?php
namespace model;

use objectModel\ClassModel;

//require_once(__DIR__ . "/objectModel/ClassModel.php");


class InterpretModel {
    //Match "a-z,A-Z,0-9,_,|,+,()" in certain orders between square brackets.
    //Each pair of square brackets represent a class.
    //TODO Fix regex so it does not matter which order variables and functions come in?
    const MATCHBETWEENSQUAREBRACKETS = '/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';

    private $inputString ='';
    private $classArray =[];

    public function validate($string){
        $this->inputString = $string;

        $classArray = $this->findClasses(self::MATCHBETWEENSQUAREBRACKETS,$string);
        foreach ($classArray as $class){
            $this->classArray[] = new ClassModel($class);
        }
        return ($this->classArray);
    }

    private function findClasses($regex,$string){
        preg_match_all($regex,$string,$classArray, PREG_SET_ORDER);
        return $classArray;
    }
    /*public function presentClass(){
        $array = [];
        $array["className"]= $this->classArray[0]->GetClassName();
        $array["variables"] = $this->classArray[0]->GetVariables();
        var_dump($array);
    }*/

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:50
 */