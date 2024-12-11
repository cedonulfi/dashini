<?php
// Clear the user_id cookie
setcookie('user_id', '', time() - 3600, '/');

// Redirect to login.php
header('Location: login.php');
exit;
?>
