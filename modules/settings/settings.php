<?php
session_start();
require_once("../../config.php");

// Fetch existing settings
$stmt = $pdo->query("SELECT * FROM system_settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings</title>
    <link rel="stylesheet" href="../../includes/style.css">

</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../employees/list.php">Manage Employees</a></li>
            <li><a href="settings.php" class="active">System Settings</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>System Settings</h2>

        <?php if (isset($_GET['success'])): ?>
            <p class="success">✅ Settings updated successfully!</p>
        <?php endif; ?>

        <form action="update_settings.php" method="POST">
            <label>Company Name:</label>
            <input type="text" name="company_name" value="<?= htmlspecialchars($settings['company_name']) ?>" required>

            <label>Email:</label>
            <input type="email" name="company_email" value="<?= htmlspecialchars($settings['company_email']) ?>" required>

            <label>Phone:</label>
            <input type="text" name="company_phone" value="<?= htmlspecialchars($settings['company_phone']) ?>" required>

            <label>Address:</label>
            <textarea name="company_address" rows="3" required><?= htmlspecialchars($settings['company_address']) ?></textarea>

            <label>Theme:</label>
            <select name="theme">
                <option value="light" <?= $settings['theme'] === 'light' ? 'selected' : '' ?>>Light</option>
                <option value="dark" <?= $settings['theme'] === 'dark' ? 'selected' : '' ?>>Dark</option>
            </select>

            <button type="submit">💾 Save Settings</button>
        </form>
    </div>
</body>
</html>

