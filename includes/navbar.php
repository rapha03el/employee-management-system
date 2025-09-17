<?php
// navbar.php
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav class="navbar">
    <ul>
        <li><a href="welcome.php">🏠 Home</a></li>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="admin_dashboard.php">👑 Admin Dashboard</a></li>
            <li><a href="manage_users.php">👤 Manage Users</a></li>
            <li><a href="system_settings.php">⚙️ System Settings</a></li>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'manager'): ?>
            <li><a href="manager_dashboard.php">📋 Manager Dashboard</a></li>
            <li><a href="department_employees.php">👥 Department Employees</a></li>
            <li><a href="leave_requests.php">📝 Leave Requests</a></li>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'employee'): ?>
            <li><a href="profile.php">🙋 My Profile</a></li>
            <li><a href="attendance.php">🕒 My Attendance</a></li>
            <li><a href="leave_request.php">✍️ Request Leave</a></li>
        <?php endif; ?>

        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</nav>
