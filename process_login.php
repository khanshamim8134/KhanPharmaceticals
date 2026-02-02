<?php
// Start session before any output
session_start();

// Login Processing
header('Content-Type: application/json');

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Include database configuration
require_once 'config.php';

// Create connection (handle missing database gracefully)
try {
    $conn = getDBConnection();
    if (!$conn || $conn->connect_error) {
        throw new Exception("Connection failed");
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => "Database connection failed. Please ensure MySQL is running and database '" . DB_NAME . "' exists."
    ));
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    // Validation
    $errors = array();
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        echo json_encode(array(
            "status" => "error",
            "message" => implode(", ", $errors)
        ));
        exit();
    }
    
    // Check if user exists
    $stmt = $conn->prepare("SELECT id, firstName, lastName, password FROM users WHERE email = ?");
    
    if (!$stmt) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Database error: " . $conn->error
        ));
        exit();
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Email not found. Please sign up first."
        ));
        $stmt->close();
        exit();
    }
    
    // Get user data
    $user = $result->fetch_assoc();
    
    // Verify password
    if (!password_verify($password, $user['password'])) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Invalid password. Please try again."
        ));
        $stmt->close();
        exit();
    }
    
    // Password is correct - set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $user['firstName'] . ' ' . $user['lastName'];
    $_SESSION['login_time'] = time();
    
    // Update last login time
    $update_stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
    if ($update_stmt) {
        $update_stmt->bind_param("i", $user['id']);
        $update_stmt->execute();
        $update_stmt->close();
    }
    
    echo json_encode(array(
        "status" => "success",
        "message" => "Login successful! Welcome " . $user['firstName']
    ));
    
    $stmt->close();
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid request method"
    ));
    exit();
}

$conn->close();
?>
