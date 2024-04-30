<?php
session_start();
include "coonexion.php";
var_dump($_SESSION);

try {
    $stmt = $cnx->query("SELECT jobid, jobname, companyname, jobtype, remote, jobdesc, image FROM jobsproject");
    $alljobs = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>
    <link rel="stylesheet" href="findjob.css">
</head>
<body>
<?php include "justheader.php"; ?> 

<h1>JOB LISTINGS</h1>
<div class="div1">
    <h2 class="anotherheader">UX Design - Product Design - Service Design - </h2>
</div>


<?php

if (count($alljobs) > 0) {
    foreach ($alljobs as $job) {
        echo "<div class='job'>";
        echo "<h2>{$job['jobname']}</h2>";
        echo "<div class='company-info'>";
        echo "<p><strong>Company:    </strong></p>";
        echo "<img src='data:image/jpeg;base64,".base64_encode($job['image'])."' />";
        echo "<p>{$job['companyname']}</p>";
        echo "</div>";
        echo "<p><strong>Type:</strong> {$job['jobtype']}</p>";
        echo "<p><strong>Remote:</strong> {$job['remote']}</p>";
        echo "<a href='description.php?id={$job['jobid']}'> <button class='show-description' data-desc='{$job['jobdesc']}'>See description</button></a>"; 
        echo "</div>";
    }
} else {
    echo "<p>No jobs yet.</p>";
}
?>

</body>
</html>
