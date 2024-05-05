<?php
session_start();
include "coonexion.php";
if (isset($_SESSION['user_id'])) {
    header('Location: myprofile.php');
    exit;
}
function checkEmail($cnx, $email)
{
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

function checkPhone($cnx, $phone)
{
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE phone = ?");
    $stmt->execute([$phone]);
    return $stmt->fetch() !== false;
}

if (isset($_POST['save']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $type = $_POST['type1'];
    $companyname = isset($_POST['companyname']) ? $_POST['companyname'] : '';

    // Hash the password securely
    $hashedPassword = md5($pass);

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

    // check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $pic = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $pic = NULL;
    }

    // Insert user into database
    $stmt = $cnx->prepare("INSERT INTO webuser (nom, prenom, email, pass, phone, type1, companyname, pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $hashedPassword);
    $stmt->bindParam(5, $phone);
    $stmt->bindParam(6, $type);
    $stmt->bindParam(7, $companyname);
    $stmt->bindParam(8, $pic, PDO::PARAM_LOB);
    $stmt->execute();

    // Redirect to dashboard
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

    <table>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="pass" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <p>By clicking Accept & Sign Up, you agree to <a href="#">GOODJOBS's Terms of Service</a>, <a
                        href="#">Privacy Policy</a>, and <a href="#">Cookie Policy</a>.</p>
            </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="nom" required></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input type="text" name="prenom" required></td>
        </tr>
        <tr>
            <td>Phone number:</td>
            <td><input type="text" name="phone" required></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <input type="radio" name="type1" id="jobSeeker" value="jobSeeker" onclick="radioFunction()"> Job Seeker
                <br>
                <input type="radio" name="type1" id="company" value="company" onclick="radioFunction()"> Company <br>
                <div id="companyNameInput" style="display:none">
                    Company name: <input type="text" name="companyname">
                </div>
                <input type="hidden" name="ncompanyname" id="hiddenCompanyInput">
            </td>
        </tr>
        <tr>
            <td>Image:</td>
            <td><input type="file" name="image" id="pic" accept="image/*"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit" name="save">Submit</button></td>
        </tr>
    </table>

    <script>
        function radioFunction() {
            var jobSeekerRadio = document.getElementById("jobSeeker");
            var companyNameInput = document.getElementById("companyNameInput");
            var hiddenCompanyInput = document.getElementById("hiddenCompanyInput");

            if (jobSeekerRadio.checked) {
                companyNameInput.style.display = "none";
                hiddenCompanyInput.value = '';
            } else {
                companyNameInput.style.display = "block";
                hiddenCompanyInput.value = '';
            }
        }
    </script>
</body>

</html>