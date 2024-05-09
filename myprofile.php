<?php
session_start();

if (!isset($_SESSION['user_id'])) {

    header('Location: login.php');
    exit;
}

include "coonexion.php";

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



    <div class="job">
        <h2>Welcome, <?php echo $user['nom']; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> +216 <?php echo $user['phone']; ?></p>
        <p><strong>name:</strong> <?php echo $user['nom']; ?></p>
        <p><strong>last name:</strong> <?php echo $user['prenom']; ?></p>
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
            echo "<p><strong>Company named: </strong>" . $user['companyname'] . "</p>";
        }
        ?>
        <a href="modif.php?id=<?php echo $user_id; ?>" class="modify">Modify account</a>
        <a href="password.php?id=<?php echo $user_id; ?>" class="pass">Modify Password</a>
        <a href="logout.php" class="logout">Logout</a>
        <a href="delete.php?id=<?php echo htmlspecialchars($user_id); ?>" class="delete"
            onclick="return confirm('Do you really want to delete this account?');">Delete account</a>
    </div>
    <?php
    if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'jobSeeker') {
        echo " <div class='createcv'>";
        echo "<a href='createcv.php?id=<?php echo $user_id; ?>'>";
        echo "<p>I want to create a CV</p>";
        echo " </a>";
    }
    ?>

    </div>

</body>

</html>