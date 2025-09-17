<?php
// dashboard_layout.php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Dashboard'; ?></title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <?php include("navbar.php"); ?>

    <div class="dashboard-container">
        <h1><?php echo $heading ?? 'Dashboard'; ?></h1>
        <div class="dashboard-cards">
            <?php echo $content ?? ''; ?>
        </div>
    </div>
</body>
</html>
