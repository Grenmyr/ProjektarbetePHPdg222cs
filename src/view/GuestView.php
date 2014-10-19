<?php
namespace src\view;
use model\InterpretModel;
use objectModel\ClassModel;
use objectModel\FunctionModel;
use objectModel\VariableModel;
use src\view\nav\NavView;
use src\view\subview\BaseInterpretView;
use src\view\subview\PHPFactory;

class GuestView {
    protected  $message;
    protected  $input;
    protected  $phpFactory;

    protected  static $submitUMLButton = "submitumlbutton";
    protected  static $textArea = "textarea";

    /**
     * @var ClassModel[]
     */
    protected  $classModels = [];
    /**
     * @var InterpretModel;
     */
    protected  $interpretModel;

    public function __construct(){
        $this->interpretModel= new InterpretModel();
        $this->phpFactory = new PHPFactory();
    }
    public function SetInputValue($string){
            $this->input= $string;
    }
    // Return true if submit.
    public function userSubmitUml(){
       if (isset($_POST[self::$submitUMLButton])){
           $this->SetInputValue($_POST[self::$textArea]);
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
    /*public function showVariables($variables){
        $dom ='';
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
    }*/

    /**
     * @param FunctionModel[] $functions
     * @return string
     */
    /*public function showFunctions($functions){
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
    }*/
    /*public function showRelations($relations){
        $dom ='';
        //var_dump($variables);
        foreach ($relations as $relation){
                $dom .="<p>NEW (".$relation. ")<p>";
        }
        return $dom;
    }*/

    public function SetMSG($message){
        $this->message[] = $message;
    }

    /**
     * @return string
     */
    public function showInterpret(){
        $dom = '';
        if(is_array($this->classModels)){
            foreach ($this->classModels as $value){

                $className = $value->GetClassName();
                $phpClass =$this->phpFactory->GetClassNameSyntax($className);

                $variables = $value->GetVariables();
                $phpVariables="";
                foreach ($variables  as $functionObject){
                $phpVariables .= "<p>".$this->phpFactory->GetVariableSyntax($functionObject)."</p>";
                }

                $functions = $value->GetFunctions();
                $phpFunctions="";
                foreach ($functions  as $functionObject){
                    $phpFunctions .= "<p>".$this->phpFactory->GetFunctionSyntax($functionObject)."</p>";
                }

                $relations = $value->GetRelations();
                $phpRelations="";

                if(count($relations)>0){
                    $phpRelations .= "<p>".$this->phpFactory->GetEmptyConstruct()."</p>";
                    foreach ($relations  as $relation){
                       $phpRelations .= "<p>".$this->phpFactory->GetRelationSyntax($relation)."</p>";
                    }
                    $phpRelations .= "<p>".$this->phpFactory->GetEndBracket()."</p>";
                }

                $dom .= "<p>$phpClass</p> <p>".$phpRelations."</p> <p>".$phpVariables."</p><p>".$phpFunctions."}</p>"
                ;
            }
        }
        return $dom;

    }
    // Render dom from for guestView. Also Form to submit post from user.
    public function show (){
        $result = $this->showInterpret();
        $string = "<h1>UML->Code</h1>
         <a href='?action=" . NavView::$registerView . "'>Registrera</a>
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