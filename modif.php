<?php
session_start();
// Retrieve the ID to be modified
$id = $_GET['id'];

// Connection to the database
include "coonexion.php";

// Retrieve all data of the user related to the ID retrieved
$q = "SELECT * FROM webuser WHERE id=$id";
$res = $cnx->query($q);
$user = $res->fetch(); // This is ONE user
?>
<?php include "index.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modify a user</title>
    <link rel="stylesheet" href="myprofile.css">
</head>

<body>
    <h1>
        <p>Modify user</p>
    </h1>
    <form action="modif_action.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $id; ?>"><br />
        <p><strong>Nom : </strong><input type="text" name="nom" value="<?php echo $user['nom']; ?>">
            </br>
        <p><strong>Prenom : </strong><input type="text" name="prenom" value="<?php echo $user['prenom']; ?>"></br>
        <p><strong>Email:</strong><input type="email" name="email" value="<?php echo $user['email']; ?>"></br>
        <p><strong>Password : </strong><input type="password" name="pass" value=""></br>
        <p><strong>Phone : </strong><input type="text" name="phone" value="<?php echo $user['phone']; ?>"></br>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
                echo "Company Name : <input type='text' name='companyname' value=$user[companyname] ?></br>";
            } ?>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> <br>
            <input type="submit" value="Modify" name="modifier">
    </form>
</body>

</html>