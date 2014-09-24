<?php
namespace view;

class GuestView {
    private $UMLString;

    public function show (){
        $string = "<h1>UML->Code</h1>
<form enctype=multipart/form-data method=post action='?Login'>
    <fieldset>
        <legend>
            Write your UML here
        </legend>
        <p>$this->UMLString<p>
        <label>Fill in existing domain model to textarea.</label>
        <textarea cols='50' rows='5'></textarea>
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