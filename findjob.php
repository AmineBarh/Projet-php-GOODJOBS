<?php
include "coonexion.php";
$stmt = $cnx->query("SELECT jobname, companyname, jobtype, remote, jobdesc FROM jobsproject");
$alljobs = $stmt->fetchAll();

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
<?php
include "justheader.php"; ?> 

<h1>JOB LISTINGS</h1>

<?php

if (count($alljobs) > 0) {
    foreach ($alljobs as $job) {
        echo "<div class='job'>";
        echo "<h2>{$job['jobname']}</h2>";
        echo "<p><strong>Company:</strong> {$job['companyname']}</p>";
        echo "<p><strong>Type:</strong> {$job['jobtype']}</p>";
        echo "<p><strong>Remote:</strong> {$job['remote']}</p>";
        echo "<p><strong>Description:</strong> {$job['jobdesc']}</p>";
        echo "</div>";
    }
} else {
    echo "<p>No jobs yet.</p>";
}
?>

</body>
</html>
