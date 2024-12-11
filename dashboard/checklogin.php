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

// Get data from the form
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validate input
if (!empty($email) && !empty($password)) {
    // Check the user by email
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user ID in a cookie
        setcookie('user_id', $user['id'], time() + (86400 * 7), '/'); // Valid for 7 days
        header('Location: index.php');
        exit;
    } else {
        // Login failed
        echo "Incorrect email or password!";
    }
} else {
    echo "Please fill in both email and password!";
}
?>
