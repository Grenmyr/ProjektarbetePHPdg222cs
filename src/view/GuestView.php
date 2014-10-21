<?php
namespace src\view;
use model\InterpretModel;
use objectModel\ClassModel;
use src\exceptions\umltocodecontrollerexceptions\NoHTMLAllowedException;
use src\exceptions\umltocodecontrollerexceptions\UmlStringToShortException;
use src\view\nav\NavView;
use src\view\subview\PHPFactory;

class GuestView {
    protected  $message;
    protected  $input;
    protected  $phpFactory;

    protected  static $submitUMLButton = "submitumlbutton";
    protected  static $exampleUMLButton = "exampleumlbutton";
    protected  static $textArea = "textarea";

    protected  static $exampleUML = "[Domain|name|+surname|stair()|+wood()]-[Line][Domain]-[Chair|leg|+backSeat()]-[Pair]
    [Another|+plastic|kitchen()]-[LastClassExample][Domain|name|+surname|stair()|+wood()]-[road]";

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
    public function exampleSubmitUml(){
        if (isset($_POST[self::$exampleUMLButton])){
            $this->SetInputValue(self::$exampleUML);
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

/*    public function SetMSG($message){
        $this->message[] = $message;
    }*/

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

    public function renderMessages(){
        $dom = '';
        if(is_array($this->message )){
            foreach ($this->message as $messages){
                $dom .= "<p>$messages</p>";
            }
        }
        return $dom;
    }
    //TODO here i am
    // Render dom from for guestView. Also Form to submit post from user.
    public function show (){
        $result = $this->showInterpret();
        $message = $this->renderMessages();
        $input = $this->interpretModel->cleanTags($this->input);



        $string = "
         <header>
          <h3>UML->Code : Gäst, inte inloggad.</h3>
           <a href='?action=" . NavView::$registerView . "'>Registrera</a>
         </header>
         <div class='formcontent'>
            <h1>UML->Code</h1>


    <form  method=post action='?action=" . NavView::$umlSubmit . "' id='guestviewform' class='formclass'>
    <div class='message'>$message</div>
    <fieldset>
        <legend>
            Write your UML here
        </legend>

        <legend>
        Fyll i domän modellen i textfält under.
        </legend>
        <textarea  cols='50' rows='5' name='" .self::$textArea. "'>$input</textarea>
         <input type='submit' value='Ladda uml exempel' name='" .self::$exampleUMLButton. "'>
        <input type='submit' value='Generera kod' name='" .self::$submitUMLButton. "'>
        <div ></div>
         <div> $result </div>
    </fieldset>

    </form>
    </div>
        ";
        return $string;
    }

    public function toLongInputMSG()
    {
        $this->message[] = "För många tecken, 1000 är max.";
    }

    public function umlToShortMSG()
    {
        $this->message[] = "Uml är för kort minst tre tecken behövs.";
    }

    public function noHTMLMSG()
    {
        $this->message[] = 'HTML taggar ">" "<" är inte giltig syntax';
    }


}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:48
 */