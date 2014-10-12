<?php

namespace model;


use Repository;

class UMLRepository extends Repository{

    /*
     * Function that insert UML string to database.
     */
    public function add(User $user) {
        // If Empty user submit throw Exception.
        if($getUser = $this->getUserByUsername($user->GetUsername())){
            throw new \src\Exception\DbUserExistException();
        }

        try {
            $db = $this -> connection();
            $sql = "INSERT INTO " . self::$dbTable ." (" . self::$userName . ", " . self::$password . ") VALUES (?, ?)";
            $params = array($user -> GetUsername(), $user -> GetPassword());
            $query = $db -> prepare($sql);
            $query -> execute($params);
        } catch (\PDOException $e) {
            //die('An unknown error have occured.');
        }
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-24
 * Time: 15:47
 */