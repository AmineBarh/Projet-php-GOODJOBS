<?php
session_start();
include "coonexion.php";

// Get form data
$application_id = $_POST['id']; 
$application_jobid = $_POST['jobid']; 
$resume_data = $_POST['resume_file'];
$cv_data = $_POST['cv_file'];
if ($_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
    $cv_name = $_FILES['cv_file']['name'];
    $cv_tmp_name = $_FILES['cv_file']['tmp_name'];
    $cv_data = file_get_contents($cv_tmp_name);
    
    $stmt_cv = $cnx->prepare("UPDATE apply SET cv_name=?, cv_data=? WHERE id=? AND jobid=?");
    $stmt_cv->execute([$cv_name, $cv_data, $application_id, $application_jobid]);
}

if ($_FILES['resume_file']['error'] === UPLOAD_ERR_OK) {
    $resume_name = $_FILES['resume_file']['name'];
    $resume_tmp_name = $_FILES['resume_file']['tmp_name'];
    $resume_data = file_get_contents($resume_tmp_name);
    
    $stmt_resume = $cnx->prepare("UPDATE apply SET resume_name=?, resume_data=? WHERE id=? AND jobid=?");
    $stmt_resume->execute([$resume_name, $resume_data, $application_id, $application_jobid]);
}

// Redirect back to the page
header('Location: myjob.php');
exit;
?>
