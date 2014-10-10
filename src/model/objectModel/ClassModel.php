<?php
namespace objectModel;





//require_once(__DIR__ . "/VariableModel.php");
//require_once(__DIR__ . "/FunctionModel.php");

class ClassModel{
    const pipeOrPlusRegex = '/(\w+)|(\+\w+)/';
    const publicRegex = '/\+/';

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

    public function __construct($classArray){

        $this->className = $classArray[self::classNamePos];

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

        //var_dump($this->GetClassName());
        //var_dump($this->GetVariables()[0]);
        //var_dump($this->GetVariables()[1]);
        //var_dump($this->functions[1]->GetIsPrivate());

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
    public function GetVariableNames(){
        $array =[];
        foreach ($this->variables as $variable){
            $array[] = $variable->GetName();
        }
        var_dump($array[0]);
        return $array;

    }
    public function GetVariablePrivate(){
        $array =[];
        foreach ($this->variables as $variable){
            $array[] = $variable->GetName();
        }
        var_dump($array[0]);
        return $array;

    }
    public function GetFunctions(){
        return $this->functions;
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-06
 * Time: 14:10
 */