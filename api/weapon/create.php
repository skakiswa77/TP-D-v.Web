<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/weapon.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (empty($data['type']) || empty($data['damage'])) {
    http_response_code(400);
    echo json_encode(["error" => "Paramètres invalides."]);
    exit;
}

$weaponDAO = new WeaponDAO($pdo);
$id = $weaponDAO->create($data['type'], (int)$data['damage']);

http_response_code(201);
echo json_encode(["id" => $id]);
