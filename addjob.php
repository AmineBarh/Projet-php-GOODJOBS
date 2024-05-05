<?php
session_start();
include "coonexion.php";
if (isset($_POST['save'])) {
    $jobname = $_POST['jobname'];
    $companyname = $_SESSION["comp_name"];
    $jobtype = $_POST['jobtype'];
    $remote = $_POST['remote1'];
    $jobdesc = $_POST['jobdesc'];
    $image = $_SESSION['photo_id'];
    $stmt = $cnx->prepare("INSERT INTO jobsproject (jobname, companyname, jobtype, remote, jobdesc, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$jobname, $companyname, $jobtype, $remote, $jobdesc, $image]);
    $newJobID = $cnx->lastInsertId();
    $_SESSION['jobid'] = $newJobID;
    header("Location: findjob.php");
    exit;
}
?>

<?php include "index.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="addjob.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post" class="addjobform" enctype="multipart/form-data">
            <div class="input-group">
                <label for="jobname">Job name:</label>
                <input type="text" name="jobname" id="jobname" required>
            </div>
            <div class="input-group">
                <input type="hidden" name="companyname" id="companyname" required>
            </div>
            <div class="input-group">
                <input type="hidden" name="companylogo" id="companylogo" accept="image/*" required>
            </div>
            <div class="input-group">
                <label for="jobtype">Job type:</label>
                <input type="text" name="jobtype" id="jobtype" required>
            </div>
            <div class="input-group">
                <p>Remote:</p>
                <input type="radio" name="remote1" id="" value="Remote"> Remote <br>
                <input type="radio" name="remote1" id="" value="Hybrid"> Hybrid <br>
                <input type="radio" name="remote1" id="" value="On-site"> On-site <br>
            </div>
            <div class="input-group">
                <label for="jobdesc">Job description:</label>
                <textarea name="jobdesc" cols="30" rows="5" id="jobdesc"></textarea>
            </div>
            <input type="submit" value="Submit" name="save">
        </form>
    </div>
    <?php
    $thisjob = "SELECT jobname, companyname, jobtype, remote, jobdesc, image FROM jobsproject";
    $itself = $cnx->query($thisjob);
    $alljobs = $itself->fetchAll();

    ?>
</body>

</html>