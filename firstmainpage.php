<?php
// Récupérer l'id à modifier
$id = $_GET['id'];

// Connexion à la bdd
include "coonexion.php";

// Récupérer toutes les données de l'utilisateur relatif à l'ID récupéré
$q = "SELECT * FROM webuser WHERE id = :id"; // Add WHERE condition for id
$stmt = $cnx->prepare($q);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(); // Ceci est UN SEUL utilisateur
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
   <?php 
    include "justheader.php"; 
   ?>
    <div class="dashboard">
        <div class="content">
            <h1>Welcome</h1>
            <?php
            if ($user['type1'] == 'jobSeeker') {
                include "jobs.php"; // Include jobs page for job seekers
            } elseif ($user['type1'] == 'company') {
                include "addjob.php"; // Include add job page for companies
            } else {
                echo "Unknown user type";
            }
            ?>
        </div>
    </div>
</body>
</html>