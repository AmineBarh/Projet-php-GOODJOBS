<?php
session_start();
$id = $_GET['id'];
include "coonexion.php";
$stmt = $cnx->prepare("DELETE FROM webuser WHERE id = ?");
$stmt->execute([$id]);
if ($stmt->rowCount() > 0) {
    session_destroy();
    header('Location: login.php');
    exit;
} else {
    echo "Error: Unable to delete user record.";
}
?>