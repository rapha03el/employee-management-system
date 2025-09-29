<?php
session_start();
require_once "../../config.php";

// Restrict to admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Check for ID
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $position   = $_POST['position'];

    $update = $pdo->prepare("UPDATE employees 
                             SET first_name=?, last_name=?, email=?, phone=?, position=? 
                             WHERE id=?");
    if ($update->execute([$first_name, $last_name, $email, $phone, $position, $id])) {
        header("Location: list.php?updated=1");
        exit();
    } else {
        $error = "Error updating employee.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="/EMS/includes/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($employee['phone']); ?>">

            <label for="position">Position:</label>
            <input type="text" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>">

            <button type="submit">Update Employee</button>
        </form>

        <p><a href="list.php">⬅ Back to Employee List</a></p>
    </div>
</body>
</html>
