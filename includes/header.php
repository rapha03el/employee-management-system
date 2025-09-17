<?php
// ensure session for header usage
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div class="navbar">
    <h2>Employee Management System</h2>
    <ul>
        <li><a href="/ems/index.php">Dashboard</a></li>
        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin','manager'])): ?>
            <li><a href="/ems/modules/employees/list.php">Employees</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li><a href="/ems/admin/users.php">Manage Users</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/ems/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/ems/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</div>
