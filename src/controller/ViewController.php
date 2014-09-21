<?php
namespace controller;

require_once(__DIR__."/../view/PlainView.php");


class ViewController {
    private $plainView;

    /**
     * Construct Creating Associations.
     */
    public function __construct(){
        $this->plainView = new \view\PlainView();
    }

    public function bodyContent(){
        return $this->plainView->show();
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 12:51
 * Controller to show different views depending if user is logged in or not.
 */