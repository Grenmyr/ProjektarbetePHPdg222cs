<?php


namespace src\view;


use model\InterpretModel;
use objectModel\FunctionModel;
use objectModel\VariableModel;
use src\view\nav\NavView;

class MemberView extends GuestView {
    private $username;
    private $saveNameValue;
    private static $welcome="welcome";
    private static $register="register";

    private static $saveToDatabaseButton = "savetodatabase";
    private static $saveName = "savename";
    private static $saveToZip = "savetozip";

    private static $exampleUML = "[Domain|name|+surname|stair()|+wood()]-[Line][Domain]-[Chair|leg|+backSeat()]-[Pair]
    [Another|+plastic|kitchen()]-[LastClassExample][Domain|name|+surname|stair()|+wood()]-[road]";

    public  function SetSaveNameValue($saveName){
        $this->saveNameValue = $saveName;
    }

    public function loginWelcome(){
        if(isset($_GET[self::$welcome])){
            $this->SetInputValue(self::$exampleUML);
            $this->message[] = "Välkommen tillbaka " .$_GET[self::$welcome]." !";
        }
        return False;
    }
    public function cookieWelcome(){
        if(isset($_GET[self::$welcome])){
            $this->message[] = "Du valde att spara cookie och kommer automatiskt loggas in  i 7 dagar.";
        }
        return False;
    }

    public function registerWelcome(){
        if(isset($_GET[self::$register])){
            $this->SetInputValue(self::$exampleUML);
            $this->message[] = "Registreringen av användarnamnet " .$_GET[self::$register]." lyckades, du loggades in automatiskt !";
        }
        return False;
    }

    public function userSaveToServer(){
        if(isset($_POST[self::$saveToDatabaseButton])){
            $this->SetInputValue($_POST[self::$textArea]);
            $this->SetSaveNameValue($_POST[self::$saveName]);
            return true;
        }
        return false;
    }
    public function userSaveToZip(){
        if(isset($_POST[self::$saveToZip])){
            $this->SetInputValue($_POST[self::$textArea]);
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
        <a href='?action=" . NavView::$umlGetLists . "'>Hämta sparade projekt</a>
            <h2>$this->username är inloggad.</h2>
            <p>$message<p>
             <form  method=post action='?action=" . NavView::$umlSubmit . "'>
    <fieldset>
        <legend>
            Fyll i namn för spara UML->Code projekt på server.
        </legend>
        <label></label>
         <input type='text' size='20' value='$this->saveNameValue' name='" .self::$saveName."'>
        <input type='submit' value='Spara project server' name='" .self::$saveToDatabaseButton."'>
    </fieldset>
    <fieldset>
        <legend>
        Fyll i domän modellen i textfält under.
        </legend>
        <label></label>
        <textarea cols='50' rows='5' name='" .self::$textArea. "'>$this->input</textarea>
        <input type='submit' value='Rendera kod' name='" .self::$submitUMLButton. "'>
        <input type='submit' value='Spara till Zip' name='" .self::$saveToZip. "'>
         <div> $result </div>
    </fieldset>
    </form>
        ";
        return $string;
    }

    public function cookieSuccessMSG() {
        $this->message = "Inloggningen lyckades och vi kommer ihåg dig i 7 dagar.";
    }

    public function badCharInputValueMSG($value){
        $this->SetInputValue($value);
        $this->message[] = " Modell texten $value innehöll tidigare ogiltiga tecken, dom är nu borttagna.";
    }
    public function badCharSaveNameValueMSG($value){
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

    public function saveNameLengthMSG($message)
    {
        $this->message[] = " Savename är för kort, minst två tecken behövs. ";
    }

    public function umlLengthMSG()
    {
        $this->message[] = "Modell texten är för kort, minst tre tecken behövs. ";
    }

    public function LoginMSG()
    {
        $this->message[] = "Välkommen!";
    }

    public function SaveMSG( $savename)
    {
        $this->message[] = "UML koden har sparats i databasen under namnet $savename";
    }
    public function projectNotExistMSG()
    {
        $this->message[] = "Projektet existerar inte";
    }

    public function loadedProjectMSG()
    {
        $this->message[] = "Laddning av projektet lyckades.";
    }

    public function projectExistMSG()
    {
        $this->message[] = "Ett projekt med detta namnet existerar redan, byt namn och försök igen.";
    }

    public function errorDeleteMSG()
    {
        $this->message[] = "Ett oväntat fel inträffade när projektet skulle tas bort, försöt igen.";
    }

    public function deleteMSG($name)
    {
        $this->message[] = "Projektet $name togs bort.";
    }

    public function savedZipMSG()
    {
        $this->message = "Det gick bra att skapa filer, nedladdning startar strax.";
    }
}



/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:40
 */