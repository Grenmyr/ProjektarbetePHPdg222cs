<?php
namespace src\view;
use model\InterpretModel;
use objectModel\ClassModel;
use src\view\nav\NavView;
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

    public function __construct($interpretModel){
        $this->interpretModel= $interpretModel;
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
        $interpret = $this->interpretModel->validate($this->input);
        if($interpret=== null){
            $this->toLongInputMSG();
        }
        else{
            $this->classModels = $interpret;
            $this->errorInterpretMSG();
        }

    }
    public function errorInterpretMSG(){
        $errors = $this->interpretModel->errors();
        if($errors){
            $errorMSG ="Tecken som ej kunde tolkas var " . $errors ." Försök skriv om,
            eller se exempelkod för korrekt syntax";
            $this->message [] = $errorMSG;
    }
    }

    public function SetMSG($message){
        $this->message[] = $message;
    }

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
        <textarea  cols='50' rows='5' name='" .self::$textArea. "'>$this->input</textarea>
        <input type='submit' value='Get Code' name='" .self::$submitUMLButton. "'>
        <div ></div>
         <div> $result </div>
    </fieldset>

    </form>
        ";
        return $string;
    }

    public function toLongInputMSG()
    {
        $this->message[] = "För många tecken, 1000 är max.";
    }

    public function umlToShortMSG()
    {
        $$this->message[] = "Uml är för kort minst tre tecken behövs.";
    }


}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:48
 */