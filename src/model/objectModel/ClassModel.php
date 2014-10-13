<?php
namespace objectModel;





//require_once(__DIR__ . "/VariableModel.php");
//require_once(__DIR__ . "/FunctionModel.php");

class ClassModel{
    const pipeOrPlusRegex = '/(\w+)|(\+\w+)/';
    const publicRegex = '/\+/';

    const CHECKASSOCIATIONS ='/\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]\-\[(\w+)((?:\|\+?\w+)*)((?:\|\+?\w+\(\))*)\]/';

    const namesPos = 0;
    const classNamePos = 1;
    const variableNamePos = 2;
    const functionNamePos = 3;

    private $className;
    /**
     * @var VariableModel[]
     */
    private $variables = [];
    /**
     * @var FunctionModel[]
     */
    private $functions = [];

    private $relations=[];

    public function __construct($classArray){
        $this->className = $classArray[self::classNamePos];

        var_dump($classArray);

        $variableNames =$this->findNames(self::pipeOrPlusRegex,$classArray[self::variableNamePos]);
        $functionNames = $this->findNames(self::pipeOrPlusRegex,$classArray[self::functionNamePos]);

        foreach ($variableNames as $name) {
            $variableName = $name[self::namesPos];
            $this->variables[] = new VariableModel($variableName);
        }


        foreach ($functionNames as $name){
            $functionName = $name[self::namesPos];
            $this->functions[] = new FunctionModel($functionName);
        }




    }
    private  function findNames($regex,$array){
        preg_match_all($regex,$array,$classArray, PREG_SET_ORDER);
        return $classArray;
    }
    public function GetClassName(){
        return $this->className;
    }
    public function GetVariables(){
        return $this->variables;
    }
    public function GetFunctions(){
        return $this->functions;
    }
    public function SetRelations($relation){
        $this->relations[]=$relation;
    }
    public function GetRelations(){
        //var_dump($this->relations);
        return $this->relations;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-06
 * Time: 14:10
 */