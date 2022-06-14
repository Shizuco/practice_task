<?php

namespace components;
use PDO;

class Db{

    public static function getConnected(){
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        $db = new PDO($params['inst'], $params['user'], $params['password']);
        return $db;
    }
}
