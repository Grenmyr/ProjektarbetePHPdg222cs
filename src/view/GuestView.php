<?php
namespace view;
use model\InterpretModel;
use src\view\nav\NavView;

//require_once(__DIR__ . "/../model/InterpretModel.php");
//require_once(__DIR__ . "/../model/objectModel/ClassModel.php");


class GuestView {
    private $message;
    private $input;

    /**
     * @var ClassModels[]
     */
    private $classModels = [];
    /**
     * @var InterpretModel;
     */
    private $interpretModel;

    public function __construct($interpretModel){
        $this->interpretModel= $interpretModel;
    }

    // Return true if submit.
    public function userSubmit(){
       if (isset($_POST['submitButton'])){
           $this->input = $_POST['textarea'];
           return true;
       };
        return false;
    }
    // Return output as string;
    public function handleInput(){
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
    <form  method=post action='?action=" . NavView::$guestView . "'>
     <a href='?action=" . NavView::$registerView . "'>Tillbaka</a>
    <fieldset>
        <legend>
            Write your UML here
        </legend>
        <p>$this->message<p>
        <label>Fill in existing domain model to textarea.</label>
        <textarea cols='50' rows='5' name='textarea'>$this->input</textarea>
        <input type='submit' value='submit' name='submitButton'>
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