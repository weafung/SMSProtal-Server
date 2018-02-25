<?php

define("DB_HOST", "dev.mysql.server");
define("DB_USERNAME", "test");
define("DB_PASSWORD", "test");
define("DB_DATABASE", "test");

try {
    $dsn = "mysql:host=" . DB_HOST. ";dbname=" . DB_DATABASE;
    $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $db->query("SET NAMES utf8");
} catch (PDOException $e) {
    echo 1;
}
