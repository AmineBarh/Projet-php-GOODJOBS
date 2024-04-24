<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_unset();
session_destroy();

// Redirect the user to the login page after logout
header("Location: login.php");
exit;
?>
