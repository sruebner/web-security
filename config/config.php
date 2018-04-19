<?php

$mysql = [
    'host' => 'localhost',
    'database' => 'web-security',
    'user' => 'root',
    'password' => 'root'
];

$mysql['dsn'] = 'mysql:dbname=' . $mysql['database'] . ';host=' . $mysql['host'];