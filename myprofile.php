<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header('Location: login.php');
    exit;
}

// Include connection file
include "coonexion.php";

// Retrieve user details from the database based on the user's session information
$user_id = $_SESSION['user_id'];
$stmt = $cnx->prepare("SELECT * FROM webuser WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<?php include "index.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="myprofile.css">
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo $user['nom']; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> +216 <?php echo $user['phone']; ?></p>
        <p><strong>name:</strong> <?php echo $user['nom']; ?></p>
        <p><strong>last name:</strong> <?php echo $user['prenom']; ?></p>
        <p><strong>You are a:</strong> <?php echo $user['type1']; ?></p>
        <p><strong>Named: </strong> <?php echo $user['companyname']; ?></p>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <div class="createcv">
    <a href="createcv.php?id=<?php echo $user_id; ?>"><p>I want to create a CV</p></a>
    </div>
</body>
</html>