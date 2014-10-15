<?php

namespace model\repository;



use model\UML;
use src\Exception\DbUserExistException;


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

    public function getProjectsByUserID($userID)
    {
        try {
            $db = $this -> connection();
            $sql = "SELECT * FROM " . self::$dbTable . " WHERE " . self::$userID . " = ?";
            $params = array($userID);
            $query = $db -> prepare($sql);
            $query -> execute($params);
            $result = $query -> fetchAll();
            if($result){
                $umlArray = [];
                foreach($result as $project){
                    $uml= new UML();
                    $uml->SetUmlString($project[self::$projectString]);
                    $uml->SetSaveName($project[self::$projectName]);
                    $uml->SetUserID($project[self::$userID]);
                 $umlArray []= $uml;
                }
                return $umlArray;

            }
            else{
                return NULL;
            }
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