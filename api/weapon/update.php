<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';

$id = (int)$_GET['id'] ?? 0;
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (empty($data['type']) || empty($data['damage']) || $id <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Paramètres invalides."]);
    exit;
}

$weaponDAO = new WeaponDAO($pdo);
if ($weaponDAO->update($id, $data['type'], (int)$data['damage'])) {
    echo json_encode(["message" => "Succès."]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Erreur serveur."]);
}
