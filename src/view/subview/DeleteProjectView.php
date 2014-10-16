<?php
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-16
 * Time: 17:51
 */

class DeleteProjectView {

    public function show(){

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

