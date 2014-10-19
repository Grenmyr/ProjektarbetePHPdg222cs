<?php
namespace model;

use objectModel\ClassModel;

class InterpretModel {
    //Each valid signs in certain order between pair of square brackets give match and represent a class.
    const MATCHBETWEENSQUAREBRACKETS = '/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';
    // Match for associations between classes.
    const CHECKASSOCIATIONS ='/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]\-\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';

    const CLASSNAMEPOS = 1;
    const RELATIONPOS = 4;
//    private $inputString ='';
    /**
     * @var ClassModel[]
     */
    private $classArray =[];

    public function validate($string){
//        $this->inputString = $string;

        // Compare string to the 2 regex and save a class/relation for each match.
        $classArray = $this->findMatch(self::MATCHBETWEENSQUAREBRACKETS,$string);
        $relations = $this->findMatch(self::CHECKASSOCIATIONS,$string);

        // Make sure a class can only exist once with same name before setting the array of classes
        // to avoid duplicates.
        foreach ($classArray as $class){
            $eachClass = new ClassModel($class);
            if (!$this->GetClassByName($eachClass->GetClassName())) {
                $this->classArray[] = $eachClass;
            }
        }
        foreach ($relations as $relation){
            $class = $this->GetClassByName($relation[self::CLASSNAMEPOS]);
            if ($class) {
                $class->SetRelations($relation[self::RELATIONPOS]);
            }
        }
        return ($this->classArray);
    }
    private function GetClassByName($className){
        foreach ($this->classArray as $class){
            if ($class->GetClassName() === $className) {
                return $class;
            }
        }
        return null;
    }

    private function findMatch($regex,$string){
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