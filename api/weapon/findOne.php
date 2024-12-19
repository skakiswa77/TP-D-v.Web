<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';

$weaponDAO = new WeaponDAO($pdo);
$weapon = $weaponDAO->findOne((int)$_GET['id'] ?? 0);

if (!$weapon) {
    http_response_code(404);
    echo json_encode(["error" => "Ressource introuvable."]);
    exit;
}

echo json_encode($weapon);
