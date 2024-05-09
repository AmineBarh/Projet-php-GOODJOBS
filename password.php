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
    <title>Modify Password</title>
    <link rel="stylesheet" href="myprofile.css">
</head>
<body>
    <h1>
        <p>Modify Password</p>
    </h1>
    <form action="password_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"><br />
        <p><strong>Password : </strong><input type="text" name="password"></br>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> <br>
            <input type="submit" value="Modify" name="modifier" class="button-17">
    </form>
</body>

</html>