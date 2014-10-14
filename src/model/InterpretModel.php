<?php
namespace model;

use objectModel\ClassModel;

//require_once(__DIR__ . "/objectModel/ClassModel.php");


class InterpretModel {
    //Match "a-z,A-Z,0-9,_,|,+,()" in certain orders between square brackets.
    //Each pair of square brackets represent a class.
    const MATCHBETWEENSQUAREBRACKETS = '/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';
    // only match 1 time atm.
    const CHECKASSOCIATIONS ='/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]\-\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';

    private $inputString ='';
    /**
     * @var ClassModel[]
     */
    private $classArray =[];

    public function validate($string){
        $this->inputString = $string;

        $classArray = $this->find(self::MATCHBETWEENSQUAREBRACKETS,$string);
        $relations = $this->find(self::CHECKASSOCIATIONS,$string);
        foreach ($classArray as $class){
            $eachClass = new ClassModel($class);
            if (!$this->getClassByName($eachClass->GetClassName())) {
                $this->classArray[] = $eachClass;
            }
        }
        foreach ($relations as $relation){
            //var_dump('From '.$relation[1].' to '.$relation[4]);
            $class = $this->getClassByName($relation[1]);
            if ($class) {
                $class->SetRelations($relation[4]);
            }
        }
        return ($this->classArray);
    }
    private function getClassByName($className){
        foreach ($this->classArray as $class){
            if ($class->GetClassName() === $className) {
                return $class;
            }
        }
        return null;
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