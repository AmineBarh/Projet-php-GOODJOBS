<?php
session_start();
include "coonexion.php";
if(isset($_POST['login'])) {
      
    // Retrieve email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to select user with given email and password
    $stmt = $cnx->prepare("SELECT * FROM webuser WHERE email = ? AND pass = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();

    // Check if user exists and password is correct
    if($user) {
        // User authenticated, store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        // Redirect to dashboard or home page
        header('Location: findjob.php');
        exit;
    } else {
        // Invalid credentials, display error message
        echo "Invalid email or password. Please try again.";
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
            max-width: 500;
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
</body>
</html>
