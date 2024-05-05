<?php
$id = $_GET['id'];
$jobid = $_GET['jobid'];
include "coonexion.php";
$q = "SELECT * FROM apply WHERE jobid=$jobid AND id=$id";
$res = $cnx->query($q);
$job = $res->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modify Application</title>
</head>

<body>
    <h1>Modify Application</h1>
    <div class='job'>
        <form action='modifyapply_action.php' method='POST' enctype="multipart/form-data">
            <input type='hidden' name='id' value='<?php echo $job['id']; ?>'> 
            <p>CV Name: <?php echo $job['cv_name']; ?></p>
            <input type="file" name="cv_file">
            <br>
            <p>Resume Name: <?php echo $job['resume_name']; ?></p> 
            <input type="file" name="resume_file"> 
            <br>
            <input type='submit' value='Modify Application' class='button'> 
        </form>
    </div>
</body>

</html>
