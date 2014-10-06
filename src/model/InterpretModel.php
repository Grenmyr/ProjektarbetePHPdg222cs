<?php
namespace model;

require_once(__DIR__ . "/ClassModel.php");


class InterpretModel {
    const MATCHBETWEENSQUAREBRACKETS = '/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/'; //Full objects


    private $inputString ='';
    private $classArray =[];


    public function validate($string){
        $this->inputString = $string;

        $classArray = $this->find(self::MATCHBETWEENSQUAREBRACKETS,$string);



        foreach ($classArray as $class){
            $this->classArray[] = new ClassModel($class);
        }

        //var_dump($this->classArray);
        //var_dump($sanitizedClassArray);

        return ($classArray);

    }

    private function find($regex,$string){
        preg_match_all($regex,$string,$classArray, PREG_SET_ORDER);

        return $classArray;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:50
 */