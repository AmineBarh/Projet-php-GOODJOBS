<?php
include "coonexion.php";

try {
    $stmt = $cnx->query("SELECT jobname, companyname, jobtype, remote, jobdesc, image FROM jobsproject");
    $alljobs = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle database connection error
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

<?php

if (count($alljobs) > 0) {
    foreach ($alljobs as $job) {
        echo "<div class='job'>";
        echo "<h2>{$job['jobname']}</h2>";
        echo "<div class='company-info'>";
        echo "<p><strong>Company:</strong></p>";
        echo "<img src='data:image/jpeg;base64,".base64_encode($job['image'])."' />";
        echo "<p>{$job['companyname']}</p>";
        // Displaying image from database directly might impact performance
        // Consider storing image path in the database and serving images from filesystem or CDN
        echo "</div>"; // Close company-info
        echo "<p><strong>Type:</strong> {$job['jobtype']}</p>";
        echo "<p><strong>Remote:</strong> {$job['remote']}</p>";
        // Add functionality to view job description when button is clicked
        echo "<button class='show-description' data-desc='{$job['jobdesc']}'>See description</button>";
        echo "</div>";
    }
} else {
    echo "<p>No jobs yet.</p>";
}
?>

</body>
</html>
