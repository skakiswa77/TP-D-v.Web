<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';

$id = (int)$_GET['id'] ?? 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "ID invalide."]);
    exit;
}

$weaponDAO = new WeaponDAO($pdo);
$vikingDAO = new VikingDAO($pdo);

if ($weaponDAO->delete($id)) {
    $vikingDAO->removeWeaponByWeaponId($id);
    echo json_encode(["message" => "Succès."]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Erreur serveur."]);
}
