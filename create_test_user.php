<?php
// Create a test user safely using PHP (avoids shell escaping issues)
require_once __DIR__ . '/config.php';

$email = 'testuser@example.com';
$password_plain = 'Test@1234';

// Check if user exists
$stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
$hash = password_hash($password_plain, PASSWORD_DEFAULT);
$created = date('Y-m-d H:i:s');
if ($stmt->num_rows > 0) {
    // Update existing user's password to a known hash
    $stmt->close();
    $up = $conn->prepare('UPDATE users SET password = ?, updated_date = ? WHERE email = ?');
    $up->bind_param('sss', $hash, $created, $email);
    if ($up->execute()) {
        echo "Updated password for existing user: $email\n";
    } else {
        echo "Update failed: " . $up->error . "\n";
    }
    $up->close();
} else {
    $stmt->close();
    $ins = $conn->prepare('INSERT INTO users (firstName,lastName,email,phone,userType,password,company,created_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $fn = 'Test';
    $ln = 'User';
    $phone = '1234567890';
    $userType = 'customer';
    $company = 'Acme';
    $ins->bind_param('ssssssss', $fn, $ln, $email, $phone, $userType, $hash, $company, $created);
    if ($ins->execute()) {
        echo "Inserted test user: $email\n";
    } else {
        echo "Insert failed: " . $ins->error . "\n";
    }
    $ins->close();
}
$conn->close();

?>
