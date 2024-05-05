<?php
session_start(); // Start the session

// Retrieve the ID to delete
$id = $_GET['id'];

// Include the database connection file
include "coonexion.php";

// Delete the user's record
$stmt = $cnx->prepare("DELETE FROM webuser WHERE id = ?");
$stmt->execute([$id]);

// Check if the deletion was successful
if ($stmt->rowCount() > 0) {
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header('Location: login.php');
    exit;
} else {
    // If deletion fails, handle the error or redirect accordingly
    echo "Error: Unable to delete user record.";
    // Redirect to an appropriate page
    // header('Location: error.php');
    // exit;
}
?>
