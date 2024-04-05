<?php
session_start();

if(isset($_POST['login'])) {
    // Include connection file
    include "coonexion.php";
    
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form action="" method="post" class="login-form">
            <h2>Login</h2>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
