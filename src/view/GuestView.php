<?php
namespace src\view;
use model\InterpretModel;
use objectModel\ClassModel;
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
        var_dump(isset($_POST['submitumlbutton']));
        //TODO FIX THIS AND MEMBERVIEW
       if (isset($_POST[self::$submitUMLButton])){

           $this->input = $_POST[self::$textArea];
           return true;
       };
        return false;
    }
    // Return output as string;
    public function handleInput(){
        var_dump("handleInput");
        $this->classModels = $this->interpretModel->validate($this->input);
    }
    public function showVariables($variables){
        $dom ='';
        //var_dump($variables);
        foreach ($variables as $key => $variable){
            $private = $variable[$key]->GetPrivate();
            $name =$variable[$key]->GetName();
            if($private){
                $dom .= 'Private ' .$name;
            }
            else{
                $dom .= 'Public ' .$name;
            }

        }

        return $dom;
    }
    public function showInterpret(){
        $dom = '';
        if(is_array($this->classModels)){
            foreach ($this->classModels as $value){
                $className = $value->GetClassName();
                $variables[] = $value->GetVariables();
                $variableString =$this->showVariables($variables);
                $dom .= '<p>Class '.$className.' () </p> <p>'.$variableString.'</p>'
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
        <input type='submit' value='Get Code' name='submitumlbutton'>
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