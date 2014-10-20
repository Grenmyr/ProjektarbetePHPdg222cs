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



    public  function SetSaveNameValue($saveName){
        $this->saveNameValue = $saveName;
    }

    public function loginWelcome(){
        if(isset($_GET[self::$welcome])){
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

        $string = "
        <header>
         <h3>UML->Code : $this->username är inloggad.</h3>>
        <a href='?action=" . NavView::$logoutView . "'>Logga ut</a>
        <a href='?action=" . NavView::$umlGetLists . "'>Hämta sparade projekt</a>
        </header>

         <div class='formcontent'>
            <h1>UML->Code</h1>
             <form  method=post action='?action=" . NavView::$umlSubmit . "'  id='memberviewform' class='formclass'>
            <div class='message'>$message</div>
    <fieldset>
        <legend>
            Fyll i namn för spara UML->Code projekt på server.
        </legend>
         <input type='text' size='20' value='$this->saveNameValue' name='" .self::$saveName."'>
        <input type='submit' value='Spara project server' name='" .self::$saveToDatabaseButton."'>
    </fieldset>
    <fieldset>
        <legend>
        Fyll i domän modellen i textfält under.
        </legend>
        <textarea cols='50' rows='5' name='" .self::$textArea. "'>$this->input</textarea>
        <input type='submit' value='Ladda uml exempel' name='" .self::$exampleUMLButton. "'>
        <input type='submit' value='Generera kod' name='" .self::$submitUMLButton. "'>
        <input type='submit' value='Ladda ner kod' name='" .self::$saveToZip. "'>
         <div> $result </div>
    </fieldset>
    </form>
    </div>
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

    public function saveNameLengthMSG()
    {
        $this->message[] = " Savename är för kort, minst två tecken behövs. ";
    }
    public function saveNameMaxLengthMSG()
    {
        $this->message[] = " Savename är för långt, max 20 tecken tillåts. ";
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
        $this->message[] = "Det gick bra att skapa filer av tolkningsbar UML, nedladdning startar strax.";
    }

    public function umlLengthExceptionMSG()
    {
        $this->message[] = "Din UML modell är för kort, måste vara minst 3 tecken.";
    }

    public function UmlMaxLengthExceptionMSG()
    {
        $this->message[] = "Umlmodell är för lång, får ej vara mer än 1000 tecken.";
    }
}



/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:40
 */