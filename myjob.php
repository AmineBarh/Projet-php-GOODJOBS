<?php
session_start();
include "coonexion.php";
include "index.php";
if ($_SESSION['jobcomp'] == 'Company') {
    $company_name = $_SESSION['comp_name'];
    $stmt = $cnx->prepare("SELECT * FROM jobsproject WHERE companyname = ?");
    $stmt->execute([$company_name]);
    $jobs = $stmt->fetchAll();
    if (count($jobs) > 0) {
        foreach ($jobs as $job) {
            echo "<div class='job'>";
            echo "<h2>{$job['jobname']}</h2>";
            echo "<div class='company-info'>";
            echo "<p><strong>Company:    </strong></p>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($job['image']) . "' class='image-icon' />";
            echo "<p>{$job['companyname']}</p>";
            echo "</div>";
            echo "<p><strong>Type:</strong> {$job['jobtype']}</p>";
            echo "<p><strong>Remote:</strong> {$job['remote']}</p>";
            echo "<a href='modifyjob.php?id={$job['jobid']}'> <button class='button'>Modify</button></a>";
            echo "<a href='applied.php?id={$job['jobid']}'> <button class='button'>Applied</button></a>";
            echo "</div>";
        }
    } else {
        echo "<p>No jobs yet.</p>";
    }
} else {
    
        $companyname = $_SESSION['comp_name'];
    $id = $_SESSION['user_id'];
    $sql = "SELECT apply.*, jobsproject.jobname, jobsproject.companyname, jobsproject.jobdesc
    FROM apply
    JOIN jobsproject ON apply.jobid = jobsproject.jobid AND apply.companyname = jobsproject.companyname;";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $cnx->prepare("SELECT * FROM apply WHERE id = ?");
    $stmt->execute([$id]);
    if (count($result) > 0) { 
    $pdfData = $stmt->fetchColumn();
    foreach ($result as $res) {
        echo "<div class='job'>";
        echo "<p>" . "<b>". $res["jobname"] . "</b>" . " - " . $res["companyname"]. " - ". $res["jobdesc"] . "</p>";
        echo "<p>" . "$res[cv_name]" . "<br>" . "</p>";
        echo '<object data="data:application/pdf;base64,' . base64_encode($res["cv_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
        echo "<p>" . "$res[resume_name]" . "<br>". "</p>";
        echo '<object data="data:application/pdf;base64,' . base64_encode($res["resume_data"]) . '" type="application/pdf" style="height:200px;width:60%"></object><br>'; 
        echo "<a href='modifyapply.php?id=$res[id]&jobid=$res[jobid]'> <button class='button'>Modify Application</button></a>";
        echo "<a href='deleteapply.php?id=$res[id]&jobid=$res[jobid]'> <button class='button'>Delete Application</button></a>";
        echo "</div>";
    }
    } else {    
        echo "<p>" . "No applications yet" . "</p>";
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