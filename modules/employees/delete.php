<?php
session_start();
include("../../config.php");
include("../../includes/header.php");

if (!isset($_GET['id'])) {
    die("No employee ID provided.");
}

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = :id");
    $stmt->execute([':id' => $id]);

    echo "<p style='color:green;'>Employee deleted successfully!</p>";
    header("refresh:2; url=list.php");
} catch (PDOException $e) {
    echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
}
?>

 <?php include("../../includes/footer.php"); ?>
