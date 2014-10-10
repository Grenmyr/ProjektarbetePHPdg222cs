<?php
require_once("Repository.php");

class UserRepository extends Repository {
    private static $userName="username";
    private static $password="password";
    private static $userID="userID";
    private static $dbTable ='user';

    public function add(UserModel $user) {
        // If Empty user submit throw exception.
        if($getUser = $this->getUserByUsername($user->GetUsername())){
            throw new Exception();
        }

        try {
            $db = $this -> connection();
            $sql = "INSERT INTO " . self::$dbTable ." (" . self::$userName . ", " . self::$password . ") VALUES (?, ?)";
            $params = array($user -> GetUsername(), $user -> GetPassword());
            $query = $db -> prepare($sql);
            $query -> execute($params);
        } catch (\PDOException $e) {
            die('An unknown error have occured.');
        }
    }
    public function getUserByUsername($username) {
        try {
            $db = $this -> connection();
            $sql = "SELECT * FROM " . self::$dbTable . " WHERE " . self::$userName . " = ?";
            $params = array($username);
            $query = $db -> prepare($sql);
            $query -> execute($params);
            $result = $query -> fetch();
        if($result){
            $userModel = new UserModel();
            //TODO Need to think about this.
            $userModel->registerUser($result[self::$userName]);
            $userModel->SetHash($result[self::$password]);
            $userModel->SetUserID($result[self::$userID]);
            return $userModel;
        }
        else{
            return NULL;
        }
        } catch (\PDOException $e) {
            die('An unknown error have occured.');
        }
    }
    public function getUsernameByUserID($userID) {
        try {
        $db = $this -> connection();
        $sql = "SELECT * FROM " . self::$dbTable . " WHERE " . self::$userID . " = ?";
        $params = array($userID);
        $query = $db -> prepare($sql);
        $query -> execute($params);
        $result = $query -> fetch();
        if($result){
            return $result[self::$userName];
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
 * Date: 2014-09-26
 * Time: 16:05
 */