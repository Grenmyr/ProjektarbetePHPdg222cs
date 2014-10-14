<?php

namespace model;


use Repository;
use src\Exception\DbUserExistException;
use UML;
use UserRepository;

class UMLRepository extends Repository{

    private $userRepository;

    private static $projectName = "projectname";
    private static $projectString = "projectstring";
    private static $userID="userID";
    private static $dbTable ='project';

    public  function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function add(UML $uml) {
        // If Empty user submit throw Exception.
        $dbUser = $this->userRepository->getUserByUsername($uml->GetUsername());
        if($dbUser === null){
            throw new DbUserExistException();
        }
        try {
            $db = $this -> connection();
            $sql = "INSERT INTO  " . self::$dbTable . "  (" . self::$userID . ", " . self::$projectString . ",". self::$projectName .") VALUES (?, ?,?)";
            $params = array($dbUser->GetUserID(), $uml->GetUmlString(), $uml->GetSaveName());
            $query = $db -> prepare($sql);
            $query -> execute($params);
        } catch (\PDOException $e) {
             die('An unknown error have occured.');
        }
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-24
 * Time: 15:47
 */