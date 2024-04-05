<?php
include "coonexion.php";

if(isset($_POST['save'])) {
    // Récupérer le nom du job
    $jobname = $_POST['jobname'];
    
    // Récupérer la company du job
    $companyname = $_POST['companyname'];

    // Récupérer type du job
    $jobtype = $_POST['jobtype'];
    
    // Récupérer remote du job
    $remote = $_POST['remote1'];

    // Récupérer description du job
    $jobdesc = $_POST['jobdesc'];

    // Récupérer image du company
    $image = file_get_contents($_FILES['companylogo']['tmp_name']); // Read the uploaded file
    
    // Processus de sauvegarde dans la bdd en DEUX étapes :
    // 1. Préparer la requête SQL
    $stmt = $cnx->prepare("INSERT INTO jobsproject (jobname, companyname, jobtype, remote, jobdesc, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$jobname, $companyname, $jobtype, $remote, $jobdesc, $image]);
    header("Location: findjob.php");
    exit;
}
?>

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
            <label for="companyname">Company name:</label>
            <input type="text" name="companyname" id="companyname" required>
        </div>
        <div class="input-group">
            <label for="companylogo">Company logo:</label>
            <input type="file" name="companylogo" id="companylogo" accept="image/*" required>
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
// Récupérer les notes depuis la BdD :
// 1. Préparer la requête
$thisjob = "SELECT jobname, companyname, jobtype, remote, jobdesc, image FROM jobsproject";
// 2. Lancer la requête
$itself = $cnx->query($thisjob);
// Extraire (fetch) toutes les lignes (enregistrement, rows)
$alljobs = $itself -> fetchAll(); // Ceci est un tableau de tableaux associatifs

?>
</body>
</html>
