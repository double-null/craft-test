<?php

namespace App\Core;

use PDO;

class DB
{
    private static $_pdo = null;

    public static function pdo()
    {
        if (self::$_pdo === null) {
            $settings = database();
            self::$_pdo = new PDO($settings[0],$settings[1],$settings[2]);
        }
        return self::$_pdo;
    }
}
