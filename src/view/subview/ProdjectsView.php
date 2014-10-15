<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-15
 * Time: 14:33
 */

namespace src\view\subview;


use model\UML;
use src\view\nav\NavView;
class ProdjectsView {

    public function GetProjectName(){
        if(isset($_Get['name'])){
            return true;
        }
        return false;
    }
    public function GetUserID(){
        if(isset($_Get['id'])){
            return true;
        }
        return false;
    }

    public function Getstuff(){
        $urlString =$_SERVER['REQUEST_URI'];
        $newstring = explode("/",$urlString);
        $end = end($newstring);
        preg_match('/id=(\d+)/',$urlString, $ID);
        preg_match('/name=(\w+)/',$urlString, $saveName);
        $id = $ID[1];
        $saveName = $saveName[1];
            var_dump($id);
        var_dump($saveName);
    }

    /**
     * @param $umlArray
     * @param UML $umlArray
     * @return string
     */
    public function Show($umlArray)
    {
        //TODO HASH ID?
        $dom ='<ul>';
        //var_dump($variables);
        foreach ($umlArray as $uml){
                $dom .="<li><h4> Namn:  ".$uml->GetSaveName()."</h4>"
                ."<a href='?action=".NavView::$showProject."&name=".$uml->GetSaveName()."&id=".$uml->GetUserID()."'>".$uml->GetUmlString()."</a>"."</li>";
            }
        $dom .="</ul>";
       return $dom;
    }

}