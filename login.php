<?php 
session_start();
include ("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EMS</title>
</head>
<body>

<h2>Login</h2>
<form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>

    <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {
    $email= $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // password is correct
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['email'] = $user['email'];

        echo "<p style='color:green;'>Login successful! Redirecing...</p>";
        header("refresh:2; url=index.php"); 
    } else {
        echo "<p style='color:red;'>Invalid email or password!</p>";
    }
}
?>
</body>
</html> 

