<?php
// load_data.php

if (!isset($_GET['session'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Session ID not provided.']);
    exit;
}

$sessionId = preg_replace('/[^a-zA-Z0-9\-\_]/', '', $_GET['session']);
$directory = __DIR__ . '/sessions';
$filePath = $directory . '/data_' . $sessionId . '.json';

if (file_exists($filePath)) {
    header('Content-Type: application/json');
    readfile($filePath);
} else {
    // Return null if no data exists yet
    echo json_encode(null);
}
?>

