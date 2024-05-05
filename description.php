<?php
include "coonexion.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="dashbar.css">
</head>

<body>
    <?php
    include "index.php";
    // Check if job ID is provided in the URL
    if (isset($_GET['id'])) {
        $jobid = $_GET['id'];
        // Retrieve job details from the database
        $stmt = $cnx->prepare("SELECT * FROM jobsproject WHERE jobid = ?");
        $stmt->execute([$jobid]);
        $job = $stmt->fetch();
        if ($job) {
            // Display job name and description
            echo "<h2>" . $job["jobname"] . "</h2>";
            echo "<p>" . $job["jobdesc"] . "</p>";
            // Provide option to apply for the job if logged in as a job seeker
            if ($_SESSION["jobcomp"] == 'jobSeeker') {
                echo '<a href="applyjob.php?id=' . $jobid . '"><button class="postjob">Apply to this job</button></a>';
            }
        } else {
            echo "No job found with the specified ID.";
        }
    } else {
        echo "Job ID not provided.";
    }
    ?>
</body>

</html>
