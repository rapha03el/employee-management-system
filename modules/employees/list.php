<?php
session_start();
include("../../includes/auth.php");
require_login();
require_role(['admin','manager']); // only admin+manager can view employee list
include("../../config.php");
include("../../includes/header.php");

// fetch employees
$stmt = $conn->prepare("SELECT * FROM employees");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Employees</h1>
<a href="add.php" class="btn">+ Add New Employee</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr style="background:#ddd;">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Position</th>
        <th>Department</th>
        <th>Hire Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($employees as $emp): ?>
    <tr>
        <td><?= $emp['id'] ?></td>
        <td><?= $emp['first_name'] . " " . $emp['last_name'] ?></td>
        <td><?= $emp['email'] ?></td>
        <td><?= $emp['phone'] ?></td>
        <td><?= $emp['position'] ?></td>
        <td><?= $emp['department'] ?></td>
        <td><?= $emp['hire_date'] ?></td>
        <td>
            <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-edit" >Edit</a> | 
            <a href="delete.php?id=<?= $emp['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("../../includes/footer.php"); ?>
