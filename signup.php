<?php
session_start();
include "coonexion.php";
var_dump($_SESSION);

function checkEmail($cnx, $email) {
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

function checkPhone($cnx, $phone) {
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE phone = ?");
    $stmt->execute([$phone]);
    return $stmt->fetch() !== false;
}

    if(isset($_POST['save'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $type = $_POST['type1'];
    if ($_POST['type1'] == 'jobSeeker') {
        $companyname = ''; // Set companyname to empty string for Job Seekers
    } else {
        $companyname=$_POST['companyname'];
        var_dump($_SESSION); echo" <br>";
        var_dump($_POST);
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    }
    // Validate phone format
    if (!preg_match('/^[0-9]{8}$/', $phone)) {
        echo "<script>alert('Invalid phone number format');</script>";
    }

    // Check if email already exists
    if (checkEmail($cnx, $email)) {
        echo "<script>alert('Email already exists');</script>";
    }
    // Check if phone already exists
    if (checkPhone($cnx, $phone)) {
        echo "<script>alert('Phone number already exists');</script>";
    }

    // Hash the password securely
    $hashedPassword = md5($pass);

    // Insert user into database using prepared statement
    $stmt = $cnx->prepare("INSERT INTO webuser (nom, prenom, email, pass, phone, type1, companyname) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $phone, $type, $companyname]);

    // Redirect to dashboard
    var_dump($_SESSION);
    $newUserID = $cnx->lastInsertId();
    echo "$newUserID";
    header("Location: myprofile.php?id=$newUserID");
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
        <input type="hidden" name="id">
        Email: <input type="email" name="email" required> <br>
        Password: <input type="password" name="pass" required> <br>
        <p>By clicking Accept & Sign Up, you agree to <a href="#">GOODJOBS's Terms of Service</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Policy</a>.</p>
   
        Name: <input type="text" name="nom" required> <br>
        Last Name: <input type="text" name="prenom" required> <br>
   
        Phone number: <input type="text" name="phone" required> <br>
  
        <p>Type:</p>
        <input type="radio" name="type1" id="jobSeeker" value="jobSeeker" onclick="radioFunction()"> Job Seeker <br>
        <input type="radio" name="type1" id="company" value="company" onclick="radioFunction()"> Company <br>
        <div id="companyNameInput" style="display:none">
            Company name: <input type="text" name="companyname">
        </div>
        <input type="hidden" name="ncompanyname" id="hiddenCompanyInput">
        <button type="submit" name="save">Submit</button>
    </div>
</form>

<script>
function radioFunction() {
    var jobSeekerRadio = document.getElementById("jobSeeker");
    var companyNameInput = document.getElementById("companyNameInput");
    var hiddenCompanyInput = document.getElementById("hiddenCompanyInput");
    
    if (jobSeekerRadio.checked) {
        companyNameInput.style.display = "none";
        hiddenCompanyInput.value = ''; // Set to empty string
    } else {
        companyNameInput.style.display = "block";
        hiddenCompanyInput.value = ''; // Set to empty string initially
    }
}
</script>

</body>
</html>