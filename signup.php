<?php
include "coonexion.php";

function checkEmail($cnx, $email) {
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

if(isset($_POST['save'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $type = $_POST['type1'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit;
    }

    // Check if email already exists
    if (checkEmail($cnx, $email)) {
        echo "<script>alert('Email already exists');</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $cnx->prepare("INSERT INTO webuser (nom, prenom, email, pass, phone, type1) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $phone, $type]);

    // Redirect to dashboard
    $newUserID = $cnx->lastInsertId();
    header("Location: dash.php?id=$newUserID");
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

<form id="multiStepForm" method="post">
    <div id="frm1">
        Email: <input type="text" name="email" required> <br>
        Password: <input type="text" name="pass" required> <br>
        <p>By clicking Accept & Sign Up, you agree to <a href="#">LinkedIn's Terms of Service</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Policy</a>.</p>
        <button class="next1" onclick="showNextForm('frm2')">Accept & Sign Up</button>
    </div>
    
    <div id="frm2" style="display: none;">
        Name: <input type="text" name="nom" required> <br>
        Last Name: <input type="text" name="prenom" required> <br>
        <button onclick="showNextForm('frm3')">Continue</button>
    </div>
    
    <div id="frm3" style="display: none;">
        Phone number: <input type="text" name="phone" required> <br>
        <button onclick="showNextForm('frm4')">Continue</button>
    </div>
    
    <div id="frm4" style="display: none;">
        <p>Type:</p>
        <input type="radio" name="type1" id="jobSeeker" value="jobSeeker"> Job Seeker <br>
        <input type="radio" name="type1" id="company" value="company"> Company <br>
        <a href="myprofile.php"> <input type="button" value="Submit" onclick="submitForm()"></a>
    </div>
</form>

<script>
    function showNextForm(nextFormId) {
        document.getElementById(nextFormId).style.display = "block";
    }

    function submitForm() {
        document.getElementById("multiStepForm").submit();
    }
</script>

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