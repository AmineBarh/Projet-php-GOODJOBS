<?php
include "coonexion.php";
session_start();
$jobid = $_GET['id'];
$id = $_SESSION['user_id'];
$companyname = $_SESSION['comp_name'];

$stmt = $cnx->prepare("SELECT jobdesc FROM jobsproject WHERE jobid = ?");
$stmt->execute([$jobid]);
$job = $stmt->fetch();

if(isset($_POST["apply"])) {
    $cv_name = $_FILES['cv']['name'];
    $cv_tmp_name = $_FILES['cv']['tmp_name'];
    $cv_data = file_get_contents($cv_tmp_name);
    $resume_name = $_FILES['resume']['name'];
    $resume_tmp_name = $_FILES['resume']['tmp_name'];
    $resume_data = file_get_contents($resume_tmp_name);
    $stmt = $cnx->prepare("INSERT INTO apply (jobid, id, companyname, cv_name, cv_data, resume_name, resume_data) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $jobid);
    $stmt->bindParam(2, $id);
    $stmt->bindParam(3, $companyname);
    $stmt->bindParam(4, $cv_name);
    $stmt->bindParam(5, $cv_data, PDO::PARAM_LOB);
    $stmt->bindParam(6, $resume_name);
    $stmt->bindParam(7, $resume_data, PDO::PARAM_LOB);
    $stmt->execute([$jobid, $id, $companyname, $cv_name, $cv_data, $resume_name, $resume_data]);
    header("findjob.php");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Form</title>
</head>

<body>
    <h2>Apply for a Job</h2>
    <h5>You are applying for <?php echo "$companyname"; ?></h5>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <!-- Hidden inputs for jobid, id, companyname, and description -->
            <input type="hidden" name="jobid" ><?php echo $jobid; ?>
            <input type="hidden" name="id" ><?php echo $id; ?> 
            <input type="hidden" name="companyname" ><?php echo $companyname; ?>
            <input type="hidden" name="description" ><?php echo $job['jobdesc'] ?>

            <tr>
                <td><label for="cv">Upload CV:</label></td>
                <td><input type="file" id="cv" name="cv" accept=".pdf, application/pdf" required></td>
            </tr>
            <tr>
                <td><label for="resume">Upload Resume:</label></td>
                <td><input type="file" id="resume" name="resume" accept=".pdf, application/pdf" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="apply">Apply</button></td>
            </tr>
        </table>
    </form>



</body>

</html>
