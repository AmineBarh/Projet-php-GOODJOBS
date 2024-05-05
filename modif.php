<?php
// Retrieve the ID to be modified
$id = $_GET['id'];

// Connection to the database
include "coonexion.php";

// Retrieve all data of the user related to the ID retrieved
$q = "SELECT * FROM webuser WHERE id=$id";
$res = $cnx->query($q);
$user = $res->fetch(); // This is ONE user
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modify a user</title>
</head>

<body>
    <h1>Modify user</h1>
    <form action="modif_action.php" method="GET">
        ID : <?php echo $id; ?><br />
        Nom : <input type="text" name="nom" value="<?php echo $user['nom']; ?>">
        </br>
        Prenom : <input type="text" name="prenom" value="<?php echo $user['prenom']; ?>"></br>
        Email : <input type="email" name="email" value="<?php echo $user['email']; ?>"></br>
        Password : <input type="password" name="pass" value="<?php echo $user['pass']; ?>"></br>
        Phone : <input type="text" name="phone" value="<?php echo $user['phone']; ?>"></br>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['jobcomp'] == 'Company') {
        echo "Company Name : <input type='text' name='companyname' value=$user[companyname] ?>></br>";
        } ?>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> <br>
        <input type="submit" value="Modify" name="modifier">
    </form>
</body>

</html>
