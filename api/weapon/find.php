<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';

$weaponDAO = new WeaponDAO($pdo);
$weapons = $weaponDAO->findAll();

echo json_encode($weapons);
