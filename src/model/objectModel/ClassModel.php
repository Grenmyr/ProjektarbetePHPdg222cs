<?php
namespace objectModel;

class ClassModel{
    const pipeOrPlusRegex = '/(\w+)|(\+\w+)/';

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

    // Set classname,variables,functions by dependency injection from interpretmodel.
    public function __construct($classArray){
        $this->className = $classArray[self::classNamePos];

        $variableNames =$this->findNames(self::pipeOrPlusRegex,$classArray[self::variableNamePos]);
        foreach ($variableNames as $name) {
            $variableName = $name[self::namesPos];
            $this->variables[] = new VariableModel($variableName);
        }

        $functionNames = $this->findNames(self::pipeOrPlusRegex,$classArray[self::functionNamePos]);
        foreach ($functionNames as $name){
            $functionName = $name[self::namesPos];
            $this->functions[] = new FuncModel($functionName);
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
        return $this->relations;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-06
 * Time: 14:10
 */