<?php

namespace controller;

use src\view\nav\NavView;

class MasterController {


    public function render(){
        switch(NavView::getAction()){
            case NavView::$guestView;
                $controller = new ViewController();
                return $controller->body();
            case NavView::$registerView;
                $controller = new RegisterController();
                return $controller->body();
        }

    }



}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 13:35
 */