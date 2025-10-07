<?php
session_start();
require_once "config.php";

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | EMS</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <!-- 🌐 Top Navigation Bar -->
    <header class="navbar">
        <div class="logo">EMS Admin</div>
        <nav>
            <a href="dashboard.php">Home</a>
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="modules/employees/list.php">Manage Users</a>
            <a href="modules/settings/settings.php">System Settings</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </header>

    <!-- 🏠 Main Dashboard Section -->
    <main class="dashboard">
        <h1>Welcome, Admin 👋</h1>
        <p class="subtitle">Select an action below to manage your system</p>

        <div class="dashboard-grid">
            <!-- Manage Employees -->
            <a href="modules/employees/list.php" class="dashboard-card">
                <h3>👨‍💼 Manage Employees</h3>
                <p>View, add, edit, or remove employees from the system.</p>
            </a>

            <!-- View Reports -->
            <a href="modules/reports/reports.php" class="dashboard-card">
                <h3>📊 View Reports</h3>
                <p>Check system activity, performance, and staff reports.</p>
            </a>

            <!-- System Settings -->
            <a href="modules/settings/settings.php" class="dashboard-card">
                <h3>⚙️ System Settings</h3>
                <p>Update system configurations and user permissions.</p>
            </a>
        </div>
    </main>

</body>
</html>
