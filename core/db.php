<?php

class DB {

    private static $params;

    public static $pdo;

    public static function setConnection() {
        self::$params = include_once (CONFIG_PATH.'/db.php');
        self::$pdo = new PDO('mysql:host='. self::$params['host'] .';dbname='. self::$params['dbname'], self::$params['user'], self::$params['password'],
            [
                \PDO::ATTR_ERRMODE 				=> \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE 	=> \PDO::FETCH_ASSOC,
            ]
        );
    }


}