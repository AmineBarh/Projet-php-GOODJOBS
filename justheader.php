<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="dashbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    session_start();

    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    include "coonexion.php";

    $user_id = $_SESSION['user_id'];
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    ?>
    <div id="bardash">
    <div class="main-container">
      <div class="link-ellipse"></div>
      <div class="div-bardash">
        <a href="findjob.php"><span class="link-heading-find">Find Jobs</span></a> 
        <a href="myjob.php"><span class="link-heading-my">My jobs</span></a>         
        <a href="myprofile.php" class="link-ellipse"><img src="Ellipse 2.png" alt="profile-logo"></a>
      </div>
    </div>
        <div>
            <?php 
            echo " <div class='hello-fgg-welcome' > Hello ". $user['nom'] . " welcome back </div>";
            ?>
    
</body>
</html>