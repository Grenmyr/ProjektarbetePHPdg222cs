<?php
namespace view;
use model\InterpretModel;

require_once(__DIR__ . "/../model/InterpretModel.php");

class GuestView {
    private $message;
    private $input;
    private $interpret = [];
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
        $this->interpret = $this->interpretModel->validate($this->input);
    }
    public function showInterpret(){
        $dom = '';
        if(is_array($this->interpret)){
            foreach ($this->interpret as $value){
                $dom .= "<p>$value</p>";
            }
        }
        return $dom;

    }
    // Render dom from for guestView. Also Form to submit post from user.
    public function show (){
        $result = $this->showInterpret();

        $string = "<h1>UML->Code</h1>
<form enctype=multipart/form-data method=post action='?Guest'>
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