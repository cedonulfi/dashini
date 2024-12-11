<?php
// Database connection
$host = 'localhost';
$dbname = 'database_name';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if user_id cookie is set
if (!isset($_COOKIE['user_id'])) {
    // If not logged in, redirect to login.php
    header('Location: login.php');
    exit;
}

// Retrieve user information from the database
$user_id = $_COOKIE['user_id'];
$stmt = $pdo->prepare("SELECT * FROM `user` WHERE `id` = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "<h1>Welcome, " . htmlspecialchars($user['email']) . "!</h1>";
    echo '<a href="logout.php">Logout</a>';
} else {
    // If user not found, redirect to login.php
    header('Location: login.php');
    exit;
}
?>
