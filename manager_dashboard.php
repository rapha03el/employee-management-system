<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'manager') {
    header("Location: login.php");
    exit();
}

$title = "Manager Dashboard";
$heading = "Welcome, Manager 📋";

$content = '
    <div class="card">👥 Department Employees</div>
    <div class="card">📝 Approve Leave Requests</div>
    <div class="card">📊 Department Reports</div>
';

include("includes/dashboard_layout.php");
?>
