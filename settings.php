<?php

class Settings {

    /* IMPORTANT to change between local and published settings Just out comment selected choise.

     TWO PHP CLASSES READ FROM THIS SETTINGS:
        * view/nav/NavView.php
        * model/repository/Repository

    */
    /*
    //Test Settings
    public static $DB_USERNAME = "root";
    public static $DB_PASSWORD = '';
    public static $DB_HOST = '127.0.0.1';
    public static $DB_NAME = 'logindb';
    public static $ROOT_PATH = 'ProjektPHP/ProjektarbetePHPdg222cs';
    */
    //Published Settings

    public static $DB_USERNAME = 'dgrenmyr_nu';
    public static $DB_PASSWORD = 'EPDL8Vdx';
    public static $DB_HOST = 'dgrenmyr.nu.mysql';
    public static $DB_NAME = 'dgrenmyr_nu';
    //public static $DB_CONNECTION = 'mysql:host=dgrenmyr.nu.mysql;dbname=dgrenmyr_nu';
    public static $ROOT_PATH = 'ProjektarbetePHPdg222cs';

}

/**
 * Created by PhpStorm...
 * User: dav
 * Date: 2014-10-12
 * Time: 11:23
 */