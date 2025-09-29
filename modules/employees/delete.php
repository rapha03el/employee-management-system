<?php
session_start();
require_once "../../config.php";

// Restrict to admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}

$id = $_GET['id'];

// Fetch employee
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if (!$employee) {
    die("Employee not found.");
}

// Handle deletion
if (isset($_POST['confirm'])) {
    $delete = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    $delete->execute([$id]);
    header("Location: list.php?deleted=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="/EMS/includes/style.css?v=1">
</head>
<body>
    <div class="container">
        <h1>Delete Employee</h1>
        <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($employee['first_name'] . " " . $employee['last_name']); ?></strong>?</p>

        <form method="POST">
            <button type="submit" name="confirm" class="danger">Yes, Delete</button>
            <a href="list.php" class="button">Cancel</a>
        </form>
    </div>
</body>
</html>
