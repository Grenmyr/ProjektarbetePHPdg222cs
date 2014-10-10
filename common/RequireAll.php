<?php

//commmon
require_once(__DIR__."/HTMLView.php");

//src/controller
require_once(__DIR__."/../src/controller/ViewController.php");
require_once(__DIR__."/../src/controller/MasterController.php");
require_once(__DIR__."/../src/controller/RegisterController.php");


//src/view
require_once(__DIR__ . "/../src/view/GuestView.php");
require_once(__DIR__ . "/../src/view/RegisterView.php");

//src/view/subview
require_once(__DIR__ . "/../src/View/subview/SweDateView.php");

//src/view/nav
require_once(__DIR__ . "/../src/view/nav/NavView.php");






//src/model
require_once(__DIR__."/../src/model/DataBaseConnection.php");
require_once(__DIR__ . "/../src/model/InterpretModel.php");
require_once(__DIR__ . "/../src/model/UMLRepository.php");
require_once(__DIR__ . "/../src/model/RegisterModel.php");
require_once(__DIR__ . "/../src/model/User.php");
require_once(__DIR__ . "/../src/model/userModel.php");
require_once(__DIR__ . "/../src/model/SessionModel.php");
require_once(__DIR__ . "/../src/model/userRepository.php");
require_once(__DIR__ . "/../src/model/Repository.php");


//src/model/objectModel
require_once(__DIR__ . "/../src/model/objectModel/VariableModel.php");
require_once(__DIR__ . "/../src/model/objectModel/FunctionModel.php");
require_once(__DIR__ . "/../src/model/objectModel/ClassModel.php");

//RegisterModelExceptions
require_once(__DIR__ . "/../src/Exception/RegisterModelExceptions/RegisterUsernameLengthException.php");
require_once(__DIR__ . "/../src/Exception/RegisterModelExceptions/RegisterUsernameAndPasswordNullException.php");
require_once(__DIR__ . "/../src/Exception/RegisterModelExceptions/DbUserExistException.php");
require_once(__DIR__ . "/../src/Exception/RegisterModelExceptions/RegisterException.php");
require_once(__DIR__ . "/../src/Exception/RegisterModelExceptions/RegexException.php");




/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 14:12
 */