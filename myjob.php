<?php
session_start();
var_dump($_SESSION);
print_r($_SESSION);
include "coonexion.php";

// Retrieve the company name from the session
$company_name = $_SESSION['comp_name'];

// Prepare SQL statement to select jobs from the jobsproject table where company name matches the session variable
$stmt = $cnx->prepare("SELECT * FROM jobsproject WHERE companyname = ?");
$stmt->execute([$company_name]);
$jobs = $stmt->fetchAll();

// Display the jobs
foreach ($jobs as $job) {
    echo $job["jobname"] . " - " . $job["companyname"] . "<br>";
}
?>
