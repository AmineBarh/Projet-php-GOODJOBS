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
    
    // Processus de sauvegarde dans la bdd en DEUX étapes :
    // 1. Préparer la requête SQL
    $stmt = $cnx->prepare("INSERT INTO jobsproject (jobname, companyname, jobtype, remote, jobdesc) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$jobname, $companyname, $jobtype, $remote, $jobdesc]);
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
    <link rel="stylesheet" href="stylemain.css">
</head>
<body>

<form action="" method="post">
    Job name:<input type="text" name="jobname" required> <br>
    Company name:<input type="text" name="companyname" required> <br>
    Job type: <input type="text" name="jobtype" required> <br>
    <p>Remote:</p>
    <input type="radio" name="remote1" id="" value="Remote"> Remote <br>
    <input type="radio" name="remote1" id="" value="Hybrid"> Hybrid <br>
    <input type="radio" name="remote1" id="" value="On-site"> On-site <br> <br>
    Job description:<textarea name="jobdesc" cols="30" rows="5"></textarea> <br> <br>
    <input type="submit" value="Submit" name="save">
</form>

<?php
// Récupérer les notes depuis la BdD :
// 1. Préparer la requête
$thisjob = "SELECT jobname, companyname, jobtype, remote, jobdesc FROM jobsproject";
// 2. Lancer la requête
$itself = $cnx->query($thisjob);
// Extraire (fetch) toutes les lignes (enregistrement, rows)
$alljobs = $itself -> fetchAll(); // Ceci est un tableau de tableaux associatifs
$all = count($alljobs);
echo "Il y $all étudiants ";

?>
</body>
</html>
