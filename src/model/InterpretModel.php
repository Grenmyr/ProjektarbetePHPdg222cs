<?php
namespace model;


class InterpretModel {
    const VALIDCHARSINCLASS = '/[^a-z0-9|()-;\-]+/i';
    const MATCHBETWEENSQUAREBRACKETS = '/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/'; //Full objects


    private $inputString ='';
    private $classArray =[];


    public function validate($string){
        $this->inputString = $string;

        $classArray = $this->find(self::MATCHBETWEENSQUAREBRACKETS,$string);
        //$sanitizedClassArray= $this->sanitize(self::VALIDCHARSINCLASS,$classArray);

        //$attributelist = $this->findAttributes(self::MATCHBETWEENLINE,$sanitizedClassArray);

        var_dump($classArray);
        //var_dump($sanitizedClassArray);

        return ($classArray);

    }
    private function findAttributes($regex,$classArray){
        foreach ($classArray as $value){
            return preg_replace($regex, $value, $value);
        }
    }
    private function find($regex,$string){
        preg_match_all($regex,$string,$classArray, PREG_SET_ORDER);

        return $classArray;
    }
    private function sanitize($regex,$array){
        foreach ($array as $value){
            return preg_replace($regex, '', $value);
        }
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:50
 */