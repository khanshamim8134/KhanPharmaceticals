<?php
header('Content-Type: application/json');

// This file just checks if the server is working
$status = array(
    'server_running' => true,
    'message' => 'Server is working correctly',
    'php_version' => phpversion(),
    'current_time' => date('Y-m-d H:i:s')
);

echo json_encode($status);
?>
