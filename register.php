<?php include ('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EMS</title>
</head>
<body>
    <h2>Register New User</h2>
    <form action="register.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <br>

        <label>Role</label>
        <select name="role_id">
            <option value="1">Admin</option>
            <option value="2">HR</option>
            <option value="3">Manager</option>
            <option value="4">Employee</option>
        </select><br><br>

        <button type="submit" name="register">Register</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role_id = $_POST['role_id'];

        try {
        $stmt = $conn->prepare("INSERT INTO users (email, `password`, role_id) VALUES (:email, :password, :role_id)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();

        echo "<p style='color:green;'>User registered successfully!</p>";
        } catch (PDOException $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
    }
    ?>
</body>
</html>