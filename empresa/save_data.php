<?php
// save_data.php

// Read the raw POST data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!$data || !isset($data['session'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
    exit;
}

// Sanitize the session ID to allow only alphanumeric characters, dashes, and underscores
$sessionId = preg_replace('/[^a-zA-Z0-9\-\_]/', '', $data['session']);

// Define the directory where session files will be saved
$directory = __DIR__ . '/sessions';
if (!file_exists($directory)) {
    mkdir($directory, 0777, true);
}

$filePath = $directory . '/data_' . $sessionId . '.json';

// Save all form data (including the session id) to the JSON file
if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['status' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save data.']);
}
?>

