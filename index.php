<?php
session_start();
include("config.php");
include("includes/header.php");

// fetch total employees
$totalEmployees = $conn->query("SELECT COUNT(*) FROM employees")->fetchColumn();

// fetch total departments (distinct)
$totalDepartments = $conn->query("SELECT COUNT(DISTINCT department) FROM employees")->fetchColumn();

// fetch latest hires
$stmt = $conn->prepare("SELECT first_name, last_name, hire_date FROM employees ORDER BY hire_date DESC LIMIT 5");
$stmt->execute();
$recentHires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Dashboard</h1>

<div class="cards">
    <div class="card">
        <h2><?= $totalEmployees ?></h2>
        <p>Total Employees</p>
    </div>
    <div class="card">
        <h2><?= $totalDepartments ?></h2>
        <p>Departments</p>
    </div>
</div>

<h2>Recently Hired Employees</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Hire Date</th>
    </tr>
    <?php foreach ($recentHires as $emp): ?>
    <tr>
        <td><?= $emp['first_name'] . " " . $emp['last_name'] ?></td>
        <td><?= $emp['hire_date'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("includes/footer.php"); ?>
