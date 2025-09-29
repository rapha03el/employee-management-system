<?php
session_start();
require_once "../../config.php";

// Restrict to admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Base query
$sql = "SELECT * FROM employees WHERE 1=1";
$params = [];

// Apply same filters as list.php
if (!empty($_GET['search'])) {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
    $search = "%" . $_GET['search'] . "%";
    $params[] = $search;
    $params[] = $search;
    $params[] = $search;
}

if (!empty($_GET['position'])) {
    $sql .= " AND position = ?";
    $params[] = $_GET['position'];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set headers for download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=employees.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Column headers
fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Position'));

// Data rows
foreach ($employees as $emp) {
    fputcsv($output, $emp);
}

fclose($output);
exit();
