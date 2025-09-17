<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$title = "Admin Dashboard";
$heading = "Welcome, Admin 👑";

$content = '
    <div class="card">👤 Manage Employees</div>
    <div class="card">📋 View Reports</div>
    <div class="card">⚙️ System Settings</div>
';

include("includes/dashboard_layout.php");
?>
