<?php
session_start();
include "coonexion.php";
$id = $_POST['id'];
$pass1= $_POST['password'];
$pass=md5($pass1);
$stmt = $cnx->prepare("UPDATE webuser SET pass=? WHERE id = ?");
$stmt->execute([$pass, $id]);

// Redirect to the main page
header('Location: myprofile.php');
exit;