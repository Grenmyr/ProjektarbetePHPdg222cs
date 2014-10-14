<?php


namespace src\view;


use model\InterpretModel;
use objectModel\FunctionModel;
use objectModel\VariableModel;
use src\view\nav\NavView;

class MemberView extends GuestView {
    private $username;
    private $saveNameValue;

    private static $saveUmlButton = "saveumlbutton";
    private static $saveName = "savename";
    // new


    public function userLoggedOut(){
        if(NavView::getAction() == NavView::$logoutView){
            return true;
        }
        return false;
    }
    private function SetSaveNameValue($saveName){
        $this->saveNameValue = $saveName;
    }

    public function userSubmitSave(){
        if(isset($_POST[self::$saveUmlButton])){
            $this->SetInputValue($_POST[self::$textArea]);
            $this->SetSaveNameValue($_POST[self::$saveName]);
            return $_POST[self::$textArea];
        }
        return false;
    }
    public function GetSaveName(){
        if(isset($_POST[self::$saveName])){
            return($_POST[self::$saveName]);
        }
        return false;
    }
    public function GetTextInput(){
        if(isset($_POST[self::$textArea])){
            return($_POST[self::$textArea]);
        }
        return false;
    }

    public function cookieSuccessMSG() {
        $this->message = "Inloggningen lyckades och vi kommer ihåg dig i 7 dagar..";
    }

    public function SetUser($userName){
        $this->username = $userName;
    }
    public function GetUser(){
        return $this->username;
    }
    public function showMemberContents (){
        $result = $this->showInterpret();
        $message = $this->renderMessages();

        $string = "<h1>UML->Code</h1>
        <a href='?action=" . NavView::$logoutView . "'>Logga ut</a>
            <h2>$this->username är inloggad.</h2>
            <p>$message<p>
             <form  method=post action='?action=" . NavView::$umlSubmit . "'>
    <fieldset>
        <legend>
            Type name to save Uml->Code project.
        </legend>
        <label></label>
         <input type='text' size='20' value='$this->saveNameValue' name='" .self::$saveName."'>
        <input type='submit' value='Save Uml->Code model' name='" .self::$saveUmlButton."'>
    </fieldset>
    <fieldset>
        <legend>
            Write your UML here
        </legend>
        <label>Fill in existing domain model to textarea.</label>
        <textarea cols='50' rows='5' name='" .self::$textArea. "'>$this->input</textarea>
        <input type='submit' value='Get Code' name='" .self::$submitUMLButton. "'>
         <div> $result </div>
    </fieldset>
    </form>
        ";
        return $string;
    }
    public function badCharInputValue($value){
        $this->SetInputValue($value);
        $this->message[] = " Inputvalue $value innehöll tidigare ogiltiga tecken, dom är nu borttagna.";
    }
    public function badCharSaveNameValue($value){
        $this->SetSaveNameValue($value);
        $this->message[] = " SaveName $value innehöll tidigare ogiltiga tecken, dom är nu borttagna.";
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
}



/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:40
 */