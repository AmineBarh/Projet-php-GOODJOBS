<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include "coonexion.php";

$user_id = $_SESSION['user_id'];
$stmt = $cnx->prepare("SELECT * FROM webuser WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$image = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
</head>

<body>
  <div class="nav">
    <div class="group-2-1-wrapper">
      <img class="group-2-1" loading="lazy" alt="" src="Group 2 1.png" />
    </div>
    <div class="jobs-navigation-wrapper">
      <div class="jobs-navigation">
        <a href="findjob.php"> <b class="find-jobs">Find Jobs</b> </a>
        <a href="myjob.php"><b class="my-jobs">My jobs</b></a>
      </div>
    </div>
    <div class="frame-parent">
      <span class="hello-mister-welcome-back">
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
          echo '<a href="addjob.php"><button class="postjob">Post a Job</button></a>';
        } else {
          echo "<div class='hello-fgg-welcome'> Hello " . $user['nom'] . "</div>";
        }
        ?>

      </span>
      <?php
      echo "<a href='myprofile.php'>";
      echo "<div class='link-ellipse-1'>";
      echo "<img src='data:image/jpeg;base64," . base64_encode($user['pic']) . "' class='image-icon'/>";
      echo "</div>";
      echo "</a>";
      ?>
    </div>
  </div>
</body>

</html>