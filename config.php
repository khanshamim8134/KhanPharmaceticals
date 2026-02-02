<?php
// Database Configuration File
// Modify these settings according to your environment

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'khan_pharmaceuticals');

// Function to get database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    
    // Check connection
    if ($conn->connect_error) {
        return null;
    }
    
    // Set charset
    $conn->set_charset("utf8");
    
    return $conn;
}

// Legacy support - create global connection if requested
if (!defined('NO_GLOBAL_CONN')) {
    $conn = getDBConnection();
    
    if (!$conn) {
        // Don't die here, let the calling script handle the error
    }
}

?>
