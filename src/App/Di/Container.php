<?php

namespace App\Di;

/**
 * Class Container
 * @package App\Di
 */
class Container {

    /**
     * @return \PDO
     */
    private static function getDb() {
        $db = new \PDO("mysql:host=localhost;dbname=teste_php", "root", "");
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    /**
     * @param $name
     * @param string $data
     * @return mixed
     */
    public static function getClass($name, $data = "") {
        $str_class = "\\App\\Models\\" . ucfirst($name);
        if ($data)
            $class = new $str_class(self::getDb(), $data);
        else
            $class = new $str_class(self::getDb());
        return $class;
    }
}
