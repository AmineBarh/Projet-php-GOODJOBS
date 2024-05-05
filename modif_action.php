<?php
// Session start should be the first thing in your script
session_start();

// Connection to the database
include "coonexion.php";

// Retrieve all data of the user to be updated
$id = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$email = $_GET['email'];
$pass1 = $_GET['pass'];
$pass = md5($pass1);
$phone = $_GET['phone'];

// Check if user is logged in and has the appropriate role
if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
    $companyname = $_GET['companyname'];
    $stmt = $cnx->prepare("UPDATE apply SET companyname=? WHERE id = ?");
    $stmt->execute([$companyname]);
}

// Prepare the SQL query for update
$stmt = $cnx->prepare("UPDATE webuser SET nom=?, prenom=?, email=?, pass=?, phone=?, type1=?, companyname=? WHERE id = ?");
$stmt->execute([$nom, $prenom, $email, $pass, $phone, $type1, $companyname, $id]);

// Redirect to the main page
header('Location: myprofile.php');
exit;
?>