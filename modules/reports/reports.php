<?php
session_start();
require_once(__DIR__ . '/../../config.php');


// Only allow admins
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Fetch basic stats
$totalEmployees = $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn();
$totalAdmins = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
$totalManagers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'manager'")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Admin Dashboard</title>
    <link rel="stylesheet" href="../../includes/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f8fa;
            margin: 0;
        }

        nav {
            background-color: #222;
            padding: 1rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        nav ul li a.active {
            border-bottom: 2px solid #ffcc00;
        }

        .container {
            max-width: 1000px;
            margin: 3rem auto;
            padding: 1rem;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .report-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .report-card h3 {
            color: #0078d7;
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }

        .report-card p {
            color: #555;
        }

        a.btn {
            display: inline-block;
            background-color: #0078d7;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        a.btn:hover {
            background-color: #005a9e;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../../admin_dashboard.php">Admin Dashboard</a></li>
            <li><a href="../employees/list.php">Manage Employees</a></li>
            <li><a href="../settings/settings.php">System Settings</a></li>
            <li><a href="reports.php" class="active">Reports</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>📊 System Reports Overview</h2>

        <div class="report-grid">
            <div class="report-card">
                <h3><?= $totalEmployees ?></h3>
                <p>Total Employees</p>
            </div>

            <div class="report-card">
                <h3><?= $totalUsers ?></h3>
                <p>Total System Users</p>
            </div>

            <div class="report-card">
                <h3><?= $totalManagers ?></h3>
                <p>Total Managers</p>
            </div>

            <div class="report-card">
                <h3><?= $totalAdmins ?></h3>
                <p>Total Admins</p>
            </div>
        </div>

        <div class="back-btn">
            <a href="../../admin_dashboard.php" class="btn">⬅ Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
