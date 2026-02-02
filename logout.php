<?php
// Logout script
session_start();

// Destroy session
session_destroy();

// Redirect to home
header('Location: Project.html');
exit();
?>
