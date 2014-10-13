<?php
namespace src\view;
use model\InterpretModel;
use objectModel\ClassModel;
use objectModel\FunctionModel;
use objectModel\VariableModel;
use src\view\nav\NavView;

class GuestView {
    private $message;
    private $input;

    private static $submitUMLButton = "submitumlbutton";
    private static $textArea = "textarea";

    /**
     * @var ClassModel[]
     */
    private $classModels = [];
    /**
     * @var InterpretModel;
     */
    private $interpretModel;

    public function __construct(){
        $this->interpretModel= new InterpretModel();
    }

    // Return true if submit.
    public function userSubmit(){
       if (isset($_POST[self::$submitUMLButton])){

           $this->input = $_POST[self::$textArea];
           return true;
       };
        return false;
    }
    // Return output as string;
    public function handleInput(){
        $this->classModels = $this->interpretModel->validate($this->input);
    }

    /**
     * @param VariableModel[] $variables
     * @return string
     */
    public function showVariables($variables){
        $dom ='';
        //var_dump($variables);
        foreach ($variables as $variable){
            $private = $variable->GetPrivate();
            $name =$variable->GetName();
            if($private){
                $dom .= "<p>Private ".$name."<p>";
            }
            else{
                $dom .= "<p>Public ".$name."<p>";
            }
        }
        return $dom;
    }

    /**
     * @param FunctionModel[] $functions
     * @return string
     */
    public function showFunctions($functions){
        $dom ='';
        //var_dump($variables);
        foreach ($functions as $function){
            $private = $function->GetPrivate();
            $name =$function->GetName();
            if($private){
                $dom .="<p>private function ".$name." (){}<p>";
            }
            else{
                $dom .= "<p>public function ".$name." (){}<p>";
            }
        }
        return $dom;
    }
    public function showRelations($relations){
        $dom ='';
        //var_dump($variables);
        foreach ($relations as $relation){
                $dom .="<p>NEW".$relation."<p>";
        }
        return $dom;
    }

    /**
     *
     * @return string
     */
    public function showInterpret(){
        $dom = '';
        if(is_array($this->classModels)){
            foreach ($this->classModels as $value){
                $className = $value->GetClassName();
                $variables = $value->GetVariables();
                $functions = $value->GetFunctions();
                $relations = $value->GetRelations();
                $variableString =$this->showVariables($variables);
                $functionString =$this->showFunctions($functions);
                $relationString = $this->showRelations($relations);
                //var_dump($relations);

                $dom .= "<p>Public Class ".$className." (){</p> <p>".$relationString."<p> <p>".$variableString."</p><p>".$functionString."}</p>"
                ;
            }
        }
        return $dom;

    }
    // Render dom from for guestView. Also Form to submit post from user.
    public function show (){
        $result = $this->showInterpret();

        $string = "<h1>UML->Code</h1>
    <form  method=post action='?action=" . NavView::$umlSubmit . "'>
    <fieldset>
        <legend>
            Write your UML here
        </legend>
        <p>$this->message<p>
        <label>Fill in existing domain model to textarea.</label>
        <textarea cols='50' rows='5' name='" .self::$textArea. "'>$this->input</textarea>
        <input type='submit' value='Get Code' name='" .self::$submitUMLButton. "'>
         <div> $result </div>
    </fieldset>
    </form>
        ";
        return $string;
    }



}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:48
 */