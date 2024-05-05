<?php
session_start();
include "coonexion.php";
if(isset($_SESSION['user_id'])) {
    header('Location: myprofile.php');
    exit;
}

if (isset($_POST['login'])) {
    // Retrieve email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to select user with given email
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Check if user exists
    if ($user) {
        // Verify password
        if (md5($password) == $user['pass']) {
            // User authenticated, store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['jobcomp'] = $user['type1'];
            $_SESSION['comp_name'] = $user['companyname'];
            $_SESSION['photo_id'] = $user['pic'];
            echo "<script> var_dump($user) </script>";
            // Redirect to dashboard or home page
           header('Location: findjob.php');
           exit;
        } else {
            // Invalid password, display error message
            echo "Invalid password. Please try again.";
        }
    } else {
        // User not found, display error message
        echo "User not found. Please try again.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .login-container{
            display: table;
            margin: 100px auto 0;
            padding: 10px;
            border: 0.5px solid;
            border-color: grey;
            border-radius: 5px;
            width: 40%;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="login-container">
    <form  method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Submit</button>
    </form>
</div>
Don't have an account? <a href="signup.php">Signup</a>
</body>
</html>
