<?php
$id = $_GET['id'];
include "coonexion.php";
$q = "SELECT * FROM jobsproject WHERE jobid=$id";
$res = $cnx->query($q);
$job = $res->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modify a user</title>
</head>
<body>
    <h1>Modify Job</h1>
    <form action="modifyjob_action.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $job['jobname']; ?>"><br>
        Job Name: <input type="text" name="jobname" value="<?php echo $job['jobname']; ?>"><br>
        Job Type: <input type="text" name="jobtype" value="<?php echo $job['jobtype']; ?>"><br>
        Remote: <br>
        <input type="radio" name="remote1" id="" value="Remote"> Remote <br>
        <input type="radio" name="remote1" id="" value="Hybrid"> Hybrid <br>
        <input type="radio" name="remote1" id="" value="On-site"> On-site <br>
        Job description: <input type="textarea" name="jobdesc" value="<?php echo $job['jobdesc']; ?>"><br>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
            echo "Company Name: <input type='text' name='companyname' value='{$job['companyname']}'><br>";
        } ?>
        <input type="hidden" name="jobid" value="<?php echo $job['jobid']; ?>"><br>
        <input type="submit" value="Modify" name="modifier">
    </form>
</body>
</html>