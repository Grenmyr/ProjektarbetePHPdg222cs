<?php
namespace model\repository;

use model\User;

class CookieRepository extends Repository{
    private static $userID="userID";
    private static $expire="expire";
    private static $uniqueKey = "uniquekey";
    private static $dbTable ='uniquekey';

    public function add($unique, $expireTime, $userID) {
        try {
            $db = $this -> connection();
            $sql = "INSERT INTO  " . self::$dbTable . "  (" . self::$userID . ", " . self::$expire . ",". self::$uniqueKey .") VALUES (?, ?,?)";
            $params = array($userID, $expireTime, $unique);
            $query = $db -> prepare($sql);
            $query -> execute($params);
        } catch (\PDOException $e) {
            die('An unknown error have occured.');
        }
    }
    public function GetUniqueKey($uniqueKey) {
        try {
            $db = $this -> connection();
            $sql = "SELECT * FROM " . self::$dbTable . " WHERE " . self::$uniqueKey . " = ?";
            $params = array($uniqueKey);
            $query = $db -> prepare($sql);
            $query -> execute($params);
            $result = $query -> fetch();
            if($result){
                $user = new User();
                // Set my UserID and Expire to my dbUserModel.
                $user->SetUserID($result[self::$userID]);
                $user->SetExpire($result[self::$expire]);
                return $user;
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
 * Date: 2014-10-11
 * Time: 17:35
 */