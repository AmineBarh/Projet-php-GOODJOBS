<?php
// Session start should be the first thing in your script
session_start();

// Connection to the database
include "coonexion.php";

// Retrieve all data of the job to be updated
$id = $_GET['jobid'];
$jobname = $_GET['jobname'];
$jobtype = $_GET['jobtype'];
$remote = $_GET['remote1'];
$jobdesc = $_GET['jobdesc'];

// Prepare the SQL query for update
$stmt = $cnx->prepare("UPDATE jobsproject SET jobname=?, jobtype=?, remote=?, jobdesc=? WHERE jobid = ?");
$stmt->execute([$jobname, $jobtype, $remote, $jobdesc, $id]);

// Redirect to the main page
header('Location: myjob.php');
exit;
?>