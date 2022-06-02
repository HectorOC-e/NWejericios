<?php

class Connection
{
    private static $conn = null;
    private function __construct()
    {
    }
    public static function getConn()
    {
        if (self::$conn == null) {
            self::$conn = new SQLite3('users.db');
        }
        return self::$conn;
    }
}

?>
