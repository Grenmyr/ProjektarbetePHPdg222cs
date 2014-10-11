<?php


namespace src\view;


use src\view\nav\NavView;

class MemberView {

    public function show (){

        return "
            <h1>Projekt UML->Code dg222cs</h1>
            <h2>Inloggad</h2>
                   <a href='" . NavView::$loginView . "'>Registrera ny användare</a>

        ";
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-11
 * Time: 16:40
 */