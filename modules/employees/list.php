<?php
// list.php
session_start();
require_once __DIR__ . "/../../config.php"; //directory where config.php is located

// Restrict access: only logged-in admins should access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch employees from the database
$sql = "SELECT * FROM employees WHERE 1=1";
$params = [];

// Search filter
if (!empty($_GET['search'])) {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
    $search = "%" . $_GET['search'] . "%";
    $params[] = $search;
    $params[] = $search;
    $params[] = $search;
}

// Position filter
if (!empty($_GET['position'])) {
    $sql .= " AND position = ?";
    $params[] = $_GET['position'];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$employees = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="/EMS/includes/style.css">

</head>
<body>
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
    <div class="alert success"> Employee added successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['updated'])): ?>
    <div class="alert success"> Employee updated successfully.</div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
    <div class="alert danger"> Employee deleted successfully.</div>
    <?php endif; ?>
    
    <!-- --- Search and Filter Form --- -->
    <h1>Employee List</h1>

    <form method="GET" action="list.php" class="search-form">
    <input type="text" name="search" placeholder="Search by name or email" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

    <select name="position">
        <option value="">-- Filter by Position --</option>
        <option value="Manager" <?php if(isset($_GET['position']) && $_GET['position']=="Manager") echo "selected"; ?>>Manager</option>
        <option value="Staff" <?php if(isset($_GET['position']) && $_GET['position']=="Staff") echo "selected"; ?>>Staff</option>
        <option value="Intern" <?php if(isset($_GET['position']) && $_GET['position']=="Intern") echo "selected"; ?>>Intern</option>
    </select>

    <button type="submit">Search</button>
    <a href="list.php" class="button">Reset</a>

    <a href="export_csv.php?<?php echo http_build_query($_GET); ?>" class="button">📥 Export to CSV</a>

</form>

        <h2>👥 Manage Employees</h2>

        <!-- Add new employee button -->
        <a href="add.php" class="btn">+ Add Employee</a>

        <!-- Employee table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($employees): ?>
                    <?php foreach ($employees as $emp): ?>
                        <tr>
                            <td><?= htmlspecialchars($emp['id']) ?></td>
                            <td><?= htmlspecialchars($emp['first_name']) ?></td>
                            <td><?= htmlspecialchars($emp['last_name']) ?></td>
                            <td><?= htmlspecialchars($emp['email']) ?></td>
                            <td><?= htmlspecialchars($emp['phone']) ?></td>
                            <td><?= htmlspecialchars($emp['department']) ?></td>
                            <td><?= htmlspecialchars($emp['position']) ?></td>
                            <td><?= htmlspecialchars($emp['hire_date']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $emp['id'] ?>" class="btn-small">✏ Edit</a>
                                <a href="delete.php?id=<?= $emp['id'] ?>" 
                                   class="btn-small btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this employee?');">🗑 Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No employees found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
    // Auto-hide alerts after 3 seconds
    document.addEventListener("DOMContentLoaded", () => {
        const alerts = document.querySelectorAll(".alert");
        if (alerts.length > 0) {
            setTimeout(() => {
                alerts.forEach(alert => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000); // 3 seconds
        }
    });
</script>

</body>
</html>
