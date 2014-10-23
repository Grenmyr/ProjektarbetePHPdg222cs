<?php
require_once(__DIR__."/common/RequireAll.php");



$htmlView = new common\HTMLView();

$masterController = new \controller\MasterController();
$body =$masterController->render();

$htmlView->echoHTML($body);



/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-21
 * Time: 11:57
 */