<?php
require_once("Settings.php");
install();
function install (){
    $filePath = "documents/dg222csproject.sql";

    $contentString = 'mysql:host='.Settings::$DB_HOST;

    $createTables = new PDO($contentString, Settings::$DB_USERNAME, Settings::$DB_PASSWORD);

    $contentString ="";
    $handle = fopen(realpath($filePath),"r");
    while($line = fgets($handle)){
        $contentString .=$line;
    }
    fclose($handle);

    $replace = str_replace('logindb',Settings::$DB_NAME,$contentString);

    //var_dump($replace);
    //var_dump($contentString);
    $createTables->exec($replace);

    die("Ta bort install.php, om ni kör igen så skrivs databasen över.");
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-23
 * Time: 11:24
 */ 