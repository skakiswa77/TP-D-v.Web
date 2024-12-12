<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';

function findOneViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "
        SELECT v.id, v.name, v.health, v.attack, v.defense, v.weaponID, 
               w.type AS weapon_type, w.damage AS weapon_damage
        FROM viking v
        LEFT JOIN weapon w ON v.weaponID = w.id
        WHERE v.id = :id
    ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

function findAllVikings (string $name = "", int $limit = 10, int $offset = 0) {
    $db = getDatabaseConnection();
    $params = [];
    $sql = "
        SELECT v.id, v.name, v.health, v.attack, v.defense, v.weaponID, 
               w.type AS weapon_type, w.damage AS weapon_damage
        FROM viking v
        LEFT JOIN weapon w ON v.weaponID = w.id
    ";
    if ($name) {
        $sql .= " WHERE v.name LIKE :name";
        $params['name'] = '%' . $name . '%';
    }
    $sql .= " LIMIT $limit OFFSET $offset ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute($params);
    if ($res) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

function createViking(string $name, int $health, int $attack, int $defense, ?int $weaponID = null) {
    $db = getDatabaseConnection();
    $sql = "
        INSERT INTO viking (name, health, attack, defense, weaponID) 
        VALUES (:name, :health, :attack, :defense, :weaponID)
    ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['name' => $name, 'health' => $health, 'attack' => $attack, 'defense' => $defense, 'weaponID' => $weaponID]);
    if ($res) {
        return $db->lastInsertId();
    }
    return null;
}

function updateViking(string $id, string $name, int $health, int $attack, int $defense, ?int $weaponID = null) {
    $db = getDatabaseConnection();
    $sql = "
        UPDATE viking 
        SET name = :name, health = :health, attack = :attack, defense = :defense, weaponID = :weaponID 
        WHERE id = :id
    ";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute([
        'id' => $id,
        'name' => $name,
        'health' => $health,
        'attack' => $attack,
        'defense' => $defense,
        'weaponID' => $weaponID
    ]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}

function deleteViking(string $id) {
    $db = getDatabaseConnection();
    $sql = "DELETE FROM viking WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->rowCount();
    }
    return null;
}