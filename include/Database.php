<?php

abstract class Database {
    public const DB_HOSTNAME = 'localhost';
    public const DB_DATABASE = 'web-security';
    public const DB_USERNAME = 'root';
    public const DB_PASSWORD = 'root';

    private static $db;

    public static function getConnection(): PDO {
        if (empty($db)) {
            $dsn = 'mysql:dbname=' . self::DB_DATABASE . ';host=' . self::DB_HOSTNAME;
            self::$db = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
        }

        return self::$db;
    }
}

