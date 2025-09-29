<?php
session_start();
require_once "../../config.php";

// Optional: restrict to admin users
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $position   = $_POST['position'];

    $stmt = $pdo->prepare("INSERT INTO employees (first_name, last_name, email, phone, position) 
                           VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$first_name, $last_name, $email, $phone, $position])) {
        header("Location: list.php?success=1");
        exit();
    } else {
        $error = "Error adding employee.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../../includes/style.css">
    
</head>
<body>
    <div class="container">
        <h1>Add Employee</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone">

            <label for="position">Position:</label>
            <input type="text" name="position" id="position">

            <button type="submit">Add Employee</button>
        </form>

        <p><a href="list.php">⬅ Back to Employee List</a></p>
    </div>
</body>
</html>
