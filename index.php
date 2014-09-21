<?php
require_once("common/HTMLView.php");

class index {


$htmlView = new HTMLView();
$lc = new LoginController();

$loginContent = $lc->render();
$htmlView->echoHTML($loginContent);
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 11:57
 */