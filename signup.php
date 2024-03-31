<?php
include "coonexion.php";

if(isset($_POST['save'])) {
    // Récupérer le nom de l'utilisateur
    $nom = $_POST['nom'];
    
    // Récupérer la prenom de l'utilisateur
    $prenom = $_POST['prenom'];

    // Récupérer l'email de l'utilisateur
    $email = $_POST['email'];
    
    // Récupérer le pass de l'utilisateur
    $pass = $_POST['pass'];

    // Récupérer phone number de l'utilisateur
    $phone = $_POST['phone'];
    
    // Récupérer type(jobseeker/company) de l'utilisateur
    $type = $_POST['type1'];
    
    // Processus de sauvegarde dans la bdd en DEUX étapes :
    // 1. Préparer la requête SQL
    $stmt = $cnx->prepare("INSERT INTO webuser (nom, prenom, email, pass, phone, type1) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $pass, $phone, $type]);

    // 2. Rediriger l'utilisateur vers dash.php avec l'ID de l'utilisateur ajouté à l'URL
    $newUserID = $cnx->lastInsertId();
    header("Location: dash.php?id=$newUserID");
    exit; // Make sure to exit after redirection
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
    Email:<input type="text" name="email" required> 
    Password:<input type="text" name="pass" required>
    <p>By clicking Accept & Sign Up, you agree to  <a href="">LinkedIn's Terms of Service</a>,  <a href="">Privacy Policy</a>, and <a href="">Cookie Policy</a>.</p>
    <a href="#frm2"><input type="button" value="Accept & Sign Up" name="save1"></a>
    
    <div id="frm2">
        Name <input type="text" name="nom" required>
        Last Name<input type="text" name="prenom" required>
        <a href="#frm3"><input type="button" value="Continue" name="save2"></a>
    </div>
    
    <div id="frm3">
        Phone number:<input type="text" name="phone" required>
        <a href="#frm4"><input type="button" value="Continue" name="save3"></a>
    </div>
    
    <div id="frm4">
        <p>Type:</p>
        <input type="radio" name="type1" id="jobSeeker" value="jobSeeker"> Job Seeker <br>
        <input type="radio" name="type1" id="company" value="company"> Company <br>
        <input type="submit" value="Submit" name="save">
    </div>
</form>


  <?php
        // Récupérer les notes depuis la BdD :
        // 1. Préparer la requête
        $thisuser = "SELECT id, nom, prenom, email, pass, phone, type1 FROM webuser";
        // 2. Lancer la requête
        $himself = $cnx->query($thisuser);
        // Extraire (fetch) toutes les lignes (enregistrement, rows)
        $allusers = $himself -> fetchAll(); // Ceci est un tableau de tableaux associatifs
    //    $all = count($allusers);
    //    echo "Il y $all étudiants ";
?>
</body>
</html>