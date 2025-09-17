<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

$title = "Employee Dashboard";
$heading = "Welcome, " . $_SESSION['email'];

$content = '
    <div class="card">🙋 My Profile</div>
    <div class="card">🕒 Attendance</div>
    <div class="card">✍️ Request Leave</div>
';

include("includes/dashboard_layout.php");
?>
