<?php

namespace model;

require_once(__DIR__."/DataBaseConnection.php");


class UMLRepository extends DataBaseConnection{

    /*
     * Function that insert UML string to database.
     */
    public function add($input)
    {
        var_dump($input ."jag jobbar i UMLRepository.php");
    }
}
/**
 * Created by PhpStorm.
 * User: dav
 * Date: 2014-09-24
 * Time: 15:47
 */