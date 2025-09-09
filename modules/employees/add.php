<?php
session_start();
include("../../config.php");
include("../../includes/header.php");

if (isset($_POST['add'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $position   = $_POST['position'];
    $department = $_POST['department'];
    $hire_date  = $_POST['hire_date'];

    try {
        $stmt = $conn->prepare("INSERT INTO employees 
            (first_name, last_name, email, phone, position, department, hire_date)
            VALUES (:first_name, :last_name, :email, :phone, :position, :department, :hire_date)");

        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name'  => $last_name,
            ':email'      => $email,
            ':phone'      => $phone,
            ':position'   => $position,
            ':department' => $department,
            ':hire_date'  => $hire_date
        ]);

        echo "<p style='color:green;'>Employee added successfully!</p>";
        header("refresh:2; url=list.php");
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>

    <h1>Add New Employee</h1>

<form method="POST">
    <label>First Name</label>
    <input type="text" name="first_name" required>

    <label>Last Name</label>
    <input type="text" name="last_name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Phone</label>
    <input type="text" name="phone">

    <label>Position</label>
    <input type="text" name="position">

    <label>Department</label>
    <input type="text" name="department">

    <label>Hire Date</label>
    <input type="date" name="hire_date">

    <button type="submit" class="btn">Save</button>
    <a href="list.php" class="btn btn-danger">Cancel</a>
</form>

    <br>
    <a href="list.php">Back to Employees</a>
     <?php include("../../includes/footer.php"); ?>

