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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashini Dashboard Template</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <button class="close-sidebar">×</button> <!-- Button to close the sidebar -->
            <h2 class="logo">Dashini</h2>
            <nav class="menu">
                <a href="#overview" class="active"><i class="xmenu fa fa-home"></i>Overview</a>
                <a href="#profile"><i class="xmenu fa fa-user-circle"></i>Profile</a>
                <a href="#members"><i class="xmenu fa fa-user"></i>Members</a>
                <a href="#settings"><i class="xmenu fa fa-cog fa-spin"></i>Settings</a>
                <a href="logout.php"><i class="xmenu fa fa-close" style="color:red"></i>Logout</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="content">
            <header class="top-bar">
                <button class="hamburger">☰</button> <!-- Hamburger button -->
                <h1>Hi, <?php echo htmlspecialchars($user['email']); ?></h1>
                <div class="user-info">
                    <span class="notifications">🔔</span>
                    <img src="user.png" alt="User Avatar" class="avatar">
                </div>
            </header>
            <section class="dashboard">
                <div class="card">
                    <h3>Active Members</h3>
                    <p>1200</p>
                </div>
                <div class="card">
                    <h3>New Signups</h3>
                    <p>75</p>
                </div>
                <div class="card">
                    <h3>Revenue</h3>
                    <p>$12,450</p>
                </div>
                <div class="card">
                    <h3>Feedback</h3>
                    <p>85%</p>
                </div>
            </section>
            <section class="content-area">
                <h2>Latest Updates</h2>
                <div class="text-card">
                    <h3>Dashini Dashboard Template</h3>
                    <p>Dashini is a simple, lightweight, and responsive HTML/CSS dashboard template. It includes templates for a dashboard, login, and signup pages, designed for easy use and quick customization. This template is perfect for both learning front-end development and building small projects.</p>
                </div>
                <div class="text-card">
                    <h3>Contributing</h3>
                    <p>I am open to suggestions, improvements, or any kind of contribution. If you have any ideas on how to make Dashini better, please feel free to fork the repository, make changes, and create a pull request.</p>
                </div>
            </section>

            <!-- Footer -->
            <footer class="footer">
                &copy; 2024 Dashini Dashboard Template
            </footer>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.querySelector('.sidebar');
            const closeSidebar = document.querySelector('.close-sidebar');

            // Toggle Sidebar on Hamburger Click
            hamburger.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });

            // Close Sidebar when Close Button is Clicked
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });

            // Close Sidebar when Clicking Outside of it (Mobile)
            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
<?php
} else {
    // If user not found, redirect to login.php
    header('Location: login.php');
    exit;
}
?>
