<?php

namespace model\repository;



use model\Uml;
use src\Exception\DbUserExistException;
use src\exceptions\umltocodecontrollerexceptions\DeleteProjextException;
use src\exceptions\umltocodecontrollerexceptions\ProjectExistException;


class UMLRepository extends Repository{

    private $userRepository;
    private static $projectName = "projectname";
    private static $projectString = "projectstring";
    private static $userID="userID";
    private static $dbTable ='project';

    public  function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function add(Uml $uml) {
        // If Empty user submit throw Exception.
        $dbUser = $this->userRepository->getUserByUsername($uml->GetUsername());
        if($dbUser === null){
            throw new DbUserExistException();
        }
        $userProjects = $this->getProjectsByUserID($dbUser->GetUserID());

        // If project exist by user throw exception that controller catch.
        if($userProjects !== null){
            foreach($userProjects as $projects){
                if( $uml->GetSaveName() === $projects->GetSaveName()){
                    throw new ProjectExistException();
                }
            }
        }

       try {
            $db = $this -> connection();
            $sql = "INSERT INTO  " . self::$dbTable . "  (" . self::$userID . ", " . self::$projectString . ",". self::$projectName .") VALUES (?, ?,?)";
            $params = array($dbUser->GetUserID(), $uml->GetUmlString(), $uml->GetSaveName());
            $query = $db -> prepare($sql);
            $query -> execute($params);
        } catch (\PDOException $e) {
           throw new \Exception();
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
                    $uml= new Uml();
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
            throw new \Exception();
       }
    }

    public function getProject(Uml $uml)
    {
        $db = $this -> connection();
        $sql = "SELECT * FROM " . self::$dbTable . " WHERE " . self::$userID . " = ? AND ". self::$projectName ." = ?";
        $params = array($uml->GetUserID(),$uml->GetSaveName());
        $query = $db -> prepare($sql);
        $query -> execute($params);
        $result = $query -> fetch();
        if($result){
                $uml= new Uml();
                $uml->SetUmlString($result[self::$projectString]);
                $uml->SetSaveName($result[self::$projectName]);
                $uml->SetUserID($result[self::$userID]);
            return $uml;
        }
        else{
            return NULL;
        }

    }
    public function deleteProject(Uml $uml)
    {
        try{
        $db = $this -> connection();
        $sql = "DELETE FROM " . self::$dbTable . " WHERE " . self::$userID . " = ? AND ". self::$projectName ." = ?";
        $params = array($uml->GetUserID(),$uml->GetSaveName());
        $query = $db -> prepare($sql);
        $query -> execute($params);
        }
        catch(\PDOException $e){
            throw new DeleteProjextException();
        }
    }

}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-24
 * Time: 15:47
 */