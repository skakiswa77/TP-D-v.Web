<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

function getDatabaseConnection(): PDO {
    try {
        $host = 'localhost';
        $db = 'vikings';
        $user = 'root';
        $pass = 'root';
        $port = '8889';
        return new PDO("mysql:host=$host;dbname=$db;port=$port", $user, $pass);
    } catch (PDOException $e) {
        returnError(500, 'Could not connect to the database. ' . $e->getMessage());
        die();
    }
}