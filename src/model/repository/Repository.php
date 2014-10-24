<?php
namespace model\repository;
use Settings;

abstract class Repository {

    protected $dbUsername;
    protected $dbPassword;
    protected $dbConnstring;

    public function __construct(){
        $this->dbUsername = Settings::$DB_USERNAME;
        $this->dbPassword = Settings::$DB_PASSWORD;

        $this->dbConnstring = 'mysql:host='.Settings::$DB_HOST.';dbname='.Settings::$DB_NAME;
    }

    protected $dbConnection;
    protected function connection() {
        if ($this->dbConnection == NULL){
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);
        }
        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->dbConnection;
    }
}
/**
 * copied from https://github.com/dntoll/1dv408-HT14/blob/master/Portfolio/src/model/Repository.php
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-26
 * Time: 15:51
 */