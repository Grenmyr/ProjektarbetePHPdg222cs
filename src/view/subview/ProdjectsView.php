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


    public function GetProjectData(){
        $urlString =$_SERVER['REQUEST_URI'];
        $data = [];

        if(preg_match('/id=(\d+)/',$urlString, $ID)&& preg_match('/name=(\w+)/',$urlString, $saveName)){
            $data[]= $ID[1];
            $data[] = $saveName[1];
            return $data;
        }
        return false;
    }



    /**
     * @param $umlArray
     * @param UML $umlArray
     * @return string
     */
    public function Show($umlArray)
    {
        $dom ="<ul>";
        foreach ($umlArray as $uml){
                $dom .="<li><h4> Namn:  ".$uml->GetSaveName()."</h4>"
                ."<a href='?action=".NavView::$showProject."&name=".$uml->GetSaveName()."&id=".$uml->GetUserID()."'>".$uml->GetUmlString()."</a>"
                    ."<li>"    ."<a href='?action=".NavView::$deleteProject."&name=".$uml->GetSaveName()."&id=".$uml->GetUserID()."'>Ta bort?</a>"."</li>"
                    ."</li>"

                ;
            }
        $dom .="</ul>";
       return $dom;
    }

}