<!-- session start everytime, even from subfolders -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
$host = "localhost";
$dbname = "ems_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
