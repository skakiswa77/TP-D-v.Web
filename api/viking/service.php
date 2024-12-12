<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

function verifyViking($viking): bool {
    $name = trim($viking['name']);
    if (strlen($name) < 3) {
        returnError(412, 'Name must be at least 3 characters long');
    }

    $health = intval($viking['health']);
    if ($health < 1) {
        returnError(412, 'Health must be a positive and non zero number');
    }

    $attack = intval($viking['attack']);
    if ($attack < 1) {
        returnError(412, 'Attack must be a positive and non zero number');
    }

    $defense = intval($viking['defense']);
    if ($defense < 1) {
        returnError(412, 'Defense must be a positive and non zero number');
    }
    return true;
}