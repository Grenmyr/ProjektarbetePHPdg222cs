<?php
namespace model;

require_once(__DIR__ . "/ClassModel.php");
require_once(__DIR__ . "/RegexModel.php");


class InterpretModel extends RegexModel{
    //Match "a-zA-Z0-9_|+()" in certain orders between square brackets.
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
        return ($classArray);
    }



    /*private function findClasses($regex,$string){
        preg_match_all($regex,$string,$classArray, PREG_SET_ORDER);
        return $classArray;
    }*/

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:50
 */