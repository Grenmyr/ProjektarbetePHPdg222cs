<?php
require_once(__DIR__."/common/HTMLView.php");
require_once(__DIR__."/src/controller/ViewController.php");

$htmlView = new common\HTMLView();
$viewController = new controller\ViewController();

$viewController->input();
$body = $viewController->body();
$htmlView->echoHTML($body);

/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 11:57
 */