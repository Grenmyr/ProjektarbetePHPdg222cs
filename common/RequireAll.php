<?php
//rootpath
require_once(__DIR__ . "/../Settings.php");

//commmon
require_once(__DIR__."/HTMLView.php");

//src/controller
require_once(__DIR__ . "/../src/controller/UmlToCodeController.php");
require_once(__DIR__."/../src/controller/MasterController.php");
require_once(__DIR__."/../src/controller/RegisterController.php");
require_once(__DIR__."/../src/controller/LoginController.php");

//src/view
require_once(__DIR__ . "/../src/view/GuestView.php");
require_once(__DIR__ . "/../src/view/RegisterView.php");
require_once(__DIR__ . "/../src/view/LoginView.php");
require_once(__DIR__ . "/../src/view/MemberView.php");
require_once(__DIR__ . "/../src/view/MasterView.php");

//src/view/subview
require_once(__DIR__ . "/../src/view/subview/SweDateView.php");

//src/view/nav
require_once(__DIR__ . "/../src/view/nav/NavView.php");
//src/view/cookies
require_once(__DIR__ . "/../src/view/cookies/CookieView.php");

//src/view/subview
require_once(__DIR__ . "/../src/view/subview/ProdjectsView.php");
require_once(__DIR__ . "/../src/view/subview/SaveToZipView.php");
require_once(__DIR__ . "/../src/view/subview/PHPFactory.php");

//src/model
require_once(__DIR__ . "/../src/model/repository/Repository.php");
require_once(__DIR__ . "/../src/model/InterpretModel.php");
require_once(__DIR__ . "/../src/model/repository/UMLRepository.php");
require_once(__DIR__ . "/../src/model/RegisterModel.php");
require_once(__DIR__ . "/../src/model/User.php");
require_once(__DIR__ . "/../src/model/SessionModel.php");
require_once(__DIR__ . "/../src/model/repository/UserRepository.php");
require_once(__DIR__ . "/../src/model/LoginModel.php");
require_once(__DIR__ . "/../src/model/repository/CookieRepository.php");
require_once(__DIR__ . "/../src/model/UML.php");
require_once(__DIR__ . "/../src/model/UmlToCodeModel.php");

//src/model/objectModel
require_once(__DIR__ . "/../src/model/objectModel/VariableModel.php");
require_once(__DIR__ . "/../src/model/objectModel/FunctionModel.php");
require_once(__DIR__ . "/../src/model/objectModel/FuncModel.php");
require_once(__DIR__ . "/../src/model/objectModel/ClassModel.php");

//src/exceptions/registercontrollerexceptions
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/RegisterUsernameLengthException.php");
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/DbUserExistException.php");
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/RegisterException.php");
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/RegexException.php");
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/RegisterUsernameMaxLengthException.php");
require_once(__DIR__ . "/../src/exceptions/registercontrollerexceptions/RegisterPasswordMaxLengthException.php");

//src/exceptions/umltocodecontrollerexceptions
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/RegexSaveNameException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/RegexUmlStringException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/SaveNameLengthException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/UmlLengthException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/ProjectExistException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/DeleteProjextException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/SaveNameMaxLengthException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/UmlMaxLengthException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/UmlStringToShortException.php");
require_once(__DIR__ . "/../src/exceptions/umltocodecontrollerexceptions/NoHTMLAllowedException.php");

/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-10-10
 * Time: 14:12
 */