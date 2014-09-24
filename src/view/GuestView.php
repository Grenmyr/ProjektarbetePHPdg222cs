<?php
namespace view;

class GuestView {
    private $message;
    private $input;

    // Return true if submit.
    public function userSubmit(){
       if (isset($_POST['submitButton'])){
           $this->input = $_POST['textarea'];
           return true;
       };
        return false;
    }
    // Return output as string;
    public function GetInput(){
        return $this->input;
    }
    // Render dom from for guestView. Also Form to submit post from user.
    public function show (){
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