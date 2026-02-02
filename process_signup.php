<?php
// Set response header to JSON
header('Content-Type: application/json');

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Include database configuration
require_once 'config.php';

// Create connection using config
$conn = getDBConnection();

// Check connection
if (!$conn || $conn->connect_error) {
    echo json_encode(array(
        "status" => "error",
        "message" => "Database connection failed. Please ensure MySQL is running and database exists."
    ));
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $userType = isset($_POST['userType']) ? trim($_POST['userType']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    
    // Sanitize inputs
    $firstName = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
    $lastName = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($company, ENT_QUOTES, 'UTF-8');
    
    // Validation
    $errors = array();
    
    if (empty($firstName)) {
        $errors[] = "First Name is required";
    }
    
    if (empty($lastName)) {
        $errors[] = "Last Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($userType)) {
        $errors[] = "User Type is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // If no errors, check and insert into database
    if (empty($errors)) {
        // Check if email already exists
        $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
        
        if (!$check_email) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Database error: " . $conn->error
            ));
            exit();
        }
        
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();
        
        if ($check_email->num_rows > 0) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Email already registered"
            ));
            $check_email->close();
            exit();
        }
        $check_email->close();
        
        // Insert new user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created_date = date('Y-m-d H:i:s');
        
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, phone, userType, password, company, created_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Database error: " . $conn->error
            ));
            exit();
        }
        
        $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $phone, $userType, $hashed_password, $company, $created_date);
        
        if ($stmt->execute()) {
            echo json_encode(array(
                "status" => "success",
                "message" => "Account created successfully! Redirecting to home page..."
            ));
        } else {
            echo json_encode(array(
                "status" => "error",
                "message" => "Error creating account: " . $stmt->error
            ));
        }
        $stmt->close();
    } else {
        // Return errors
        $error_message = implode(", ", $errors);
        echo json_encode(array(
            "status" => "error",
            "message" => $error_message
        ));
    }
    
    $conn->close();
    exit();
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid request method"
    ));
    exit();
}
?>

