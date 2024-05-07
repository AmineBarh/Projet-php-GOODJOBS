<?php
session_start();
$id = $_GET['id'];
$jobid = $_GET['jobid'];
include "coonexion.php";
$stmt = $cnx->prepare("DELETE FROM apply WHERE id = ? AND jobid= ?");
$stmt->execute([$id, $jobid]);
header('Location: myjob.php');
exit;