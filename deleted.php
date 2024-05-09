<?php
session_start();
$jobid = $_GET['id'];
include "coonexion.php";
$stmt = $cnx->prepare("DELETE FROM jobsproject WHERE jobid = ?");
$stmt->execute([$jobid]);
header('Location: myjob.php');
exit;