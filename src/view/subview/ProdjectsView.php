<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-15
 * Time: 14:33
 */

namespace src\view\subview;


use model\Uml;
use src\view\nav\NavView;

class ProdjectsView
{
    private static $nameRegex = '/name=(\w+)/';

    public function GetProjectName()
    {
        $urlString = $_SERVER['REQUEST_URI'];
        if (preg_match(self::$nameRegex, $urlString, $saveName)) {
            $umlProjectName = $saveName[1];
            return $umlProjectName;
        }
        return false;
    }


    /**
     * @param $umlArray
     * @param Uml $umlArray
     * @return string
     * Generate list of projects saved by that user.
     */
    public function Show($umlArray)
    {
        $dom = "<div class='formcontent'> <ul>";
        foreach ($umlArray as $uml) {
            $dom .= "<li><h4> Namn :  " . $uml->GetSaveName() . "</h4>"
                . "<a href='?action=" . NavView::$showProject . "&amp;name=" . $uml->GetSaveName() . "'>" . $uml->GetUmlString() . "</a>"
                . "<a class='delete' href='?action=" . NavView::$deleteProject . "&amp;name=" . $uml->GetSaveName() . "'>Ta bort?</a>"
                . "</li>";
        }
        $dom .= "</ul></div>";
        return $dom;
    }

}