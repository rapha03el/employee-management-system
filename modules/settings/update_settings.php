<?php
require_once("../../config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name = $_POST['company_name'];
    $company_email = $_POST['company_email'];
    $company_phone = $_POST['company_phone'];
    $company_address = $_POST['company_address'];
    $theme = $_POST['theme'];

    $stmt = $pdo->prepare("UPDATE system_settings SET company_name=?, company_email=?, company_phone=?, company_address=?, theme=? WHERE id=1");
    $stmt->execute([$company_name, $company_email, $company_phone, $company_address, $theme]);

    header("Location: settings.php?success=1");
    exit();
}
?>
