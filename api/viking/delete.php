<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/dao/viking.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/server.php';

header('Content-Type: application/json');

if (!methodIsAllowed('delete')) {
    returnError(405, 'Method not allowed');
    return;
}

if (isset($_GET['id'])) {
    $deleted = deleteViking($_GET['id']);
    if ($deleted == 1) {
        http_response_code(204);
    } elseif ($deleted == 0) {
        returnError(404, 'Viking not found');
    } else {
        returnError(500, 'Could not delete the viking');
    }
} else {
    returnError(400, 'Missing parameter : id');
}