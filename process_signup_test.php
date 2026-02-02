<?php
// Test Sign Up - Works without database
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $userType = isset($_POST['userType']) ? trim($_POST['userType']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $company = isset($_POST['company']) ? trim($_POST['company']) : '';
    
    // Basic validation
    $errors = array();
    
    if (empty($firstName)) $errors[] = "First Name is required";
    if (empty($lastName)) $errors[] = "Last Name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (empty($userType)) $errors[] = "User Type is required";
    if (empty($password)) $errors[] = "Password is required";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match";
    
    if (empty($errors)) {
        // Save to text file as backup (for testing without database)
        $data = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'userType' => $userType,
            'company' => $company,
            'created_date' => date('Y-m-d H:i:s')
        );
        
        $file = fopen('users_backup.txt', 'a');
        fwrite($file, json_encode($data) . "\n");
        fclose($file);
        
        echo json_encode(array(
            "status" => "success",
            "message" => "Account created successfully! Redirecting..."
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => implode(", ", $errors)
        ));
    }
    exit();
} else {
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid request"
    ));
    exit();
}
?>
