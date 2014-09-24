<?php
namespace model;

abstract class DataBaseConnection {

    protected $dbUsername = 'min databas username';
    protected $dbPassword = 'min databas lösenord';
    protected $dbConnstring = 'mysql:host=127.0.0.1;dbname=portfoliodb';
    protected $dbConnection;
    protected $dbTable;
    protected function connection() {
        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);
        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->dbConnection;
    }
}
/**
 * COPIED https://github.com/dntoll/1dv408-HT14/blob/master/Portfolio/src/model/Repository.php
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-24
 * Time: 15:58
 */