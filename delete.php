<?php
session_start();
$id = $_GET['id'];
include "coonexion.php";
$stmt = $cnx->prepare("DELETE FROM webuser WHERE id = ?");
$stmt->execute([$id]);
$stmt1 = $cnx->prepare("DELETE FROM apply WHERE id = ?");
$stmt1->execute([$id]);
session_destroy();
header('Location: login.php');
exit;
?>