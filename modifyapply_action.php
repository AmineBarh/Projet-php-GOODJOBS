<?php
session_start();
include "coonexion.php";

// Get form data
$application_id = $_POST['application_id']; // Assuming each job application has a unique identifier

// Check if CV file is uploaded
if ($_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
    $cv_name = $_FILES['cv_file']['name'];
    $cv_tmp_name = $_FILES['cv_file']['tmp_name'];
    $cv_data = file_get_contents($cv_tmp_name);
    
    // Update CV data and name in the database for the specific application
    $stmt_cv = $cnx->prepare("UPDATE apply SET cv_name=?, cv_data=? WHERE id=?");
    $stmt_cv->execute([$cv_name, $cv_data, $application_id]);
}

// Check if Resume file is uploaded
if ($_FILES['resume_file']['error'] === UPLOAD_ERR_OK) {
    $resume_name = $_FILES['resume_file']['name'];
    $resume_tmp_name = $_FILES['resume_file']['tmp_name'];
    $resume_data = file_get_contents($resume_tmp_name);
    
    // Update Resume data and name in the database for the specific application
    $stmt_resume = $cnx->prepare("UPDATE apply SET resume_name=?, resume_data=? WHERE id=?");
    $stmt_resume->execute([$resume_name, $resume_data, $application_id]);
}

// Redirect back to the page
header('Location: myjob.php');
exit;
?>
