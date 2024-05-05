<?php
session_start();
include "coonexion.php";
include "index.php";
if($_SESSION['jobcomp'] =='Company')
{
    print_r($_SESSION["jobcomp"]);
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
} else {
    $companyname= $_SESSION['comp_name'];
    $id = $_SESSION['user_id'];
    
    // Prepare the SQL query
    $sql = "SELECT apply.*, jobsproject.jobname, jobsproject.jobdesc
            FROM apply
            JOIN jobsproject ON apply.jobid = jobsproject.jobid
            WHERE apply.id = :id
            AND apply.companyname = :companyname";
    
    // Prepare the statement
    $stmt = $cnx->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':companyname', $companyname);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch all rows
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $cnx->prepare("SELECT cv_data FROM apply WHERE id = ?");
    $stmt->execute([$id]);
    $pdfData = $stmt->fetchColumn();
    header('Content-type: application/pdf');

    // Output the PDF data
    echo $pdfData;
    // Output the result
    foreach ($result as $res) {
        echo "<div class='job'>";
        echo "<p>" . $res["id"] . " - " . $res["jobid"] . " - " . $res["jobdesc"] . " - " . $res["cv_data"] . "</p>";
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="findjob.css">
    <title>My job</title>
</head>
<body>
    
</body>
</html>
