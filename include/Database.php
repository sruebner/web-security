<?php

abstract class Database {
    public const DB_HOSTNAME = 'localhost';
    public const DB_DATABASE = 'webshop';
    public const DB_USERNAME = 'root';
    public const DB_PASSWORD = 'root';

    private static $db;

    private static function getConnection(): PDO {
        if (empty($db)) {
            $dsn = 'mysql:dbname=' . self::DB_DATABASE . ';host=' . self::DB_HOSTNAME;
            self::$db = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
        }

        return self::$db;
    }

    public static function query(string $query) {
        $db = self::getConnection();

        $result = $db->query($query);
        if ($result) {
            $resultData = $result->fetchAll(PDO::FETCH_ASSOC);
            $result->closeCursor();
        } else {
            $resultData = false;
        }

        return $resultData;
    }
}

