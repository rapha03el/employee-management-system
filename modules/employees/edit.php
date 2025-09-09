<?php
session_start();
include("../../config.php");
include("../../includes/header.php");

if (!isset($_GET['id'])) {
    die("No employee ID provided.");
}

$id = $_GET['id'];

// Fetch employee data
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = :id");
$stmt->execute([':id' => $id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    die("Employee not found!");
}

// Update employee if form submitted
if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $position   = $_POST['position'];
    $department = $_POST['department'];
    $hire_date  = $_POST['hire_date'];

    try {
        $stmt = $conn->prepare("UPDATE employees SET 
            first_name = :first_name,
            last_name = :last_name,
            email = :email,
            phone = :phone,
            position = :position,
            department = :department,
            hire_date = :hire_date
            WHERE id = :id");

        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name'  => $last_name,
            ':email'      => $email,
            ':phone'      => $phone,
            ':position'   => $position,
            ':department' => $department,
            ':hire_date'  => $hire_date,
            ':id'         => $id
        ]);

        echo "<p style='color:green;'>Employee updated successfully!</p>";
        header("refresh:2; url=list.php");
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>


<h1>Edit Employee</h1>

<form method="POST">
    <label>First Name</label>
    <input type="text" name="first_name" value="<?= $employee['first_name'] ?>" required>

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?= $employee['last_name'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $employee['email'] ?>" required>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= $employee['phone'] ?>">

    <label>Position</label>
    <input type="text" name="position" value="<?= $employee['position'] ?>">

    <label>Department</label>
    <input type="text" name="department" value="<?= $employee['department'] ?>">

    <label>Hire Date</label>
    <input type="date" name="hire_date" value="<?= $employee['hire_date'] ?>">

    <button type="submit" class="btn btn-edit">Update</button>
    <a href="list.php" class="btn btn-danger">Cancel</a>
</form>

    <a href="list.php">Back to Employees</a>
     <?php include("../../includes/footer.php"); ?>
</body>
</html>
