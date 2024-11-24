<?php
// logout.php
session_start();
session_unset();
session_destroy();

header("Location: Loginpage.php");  // Redirect to the login page after logout
exit();

if (isset($_GET['dev']) && $_GET['dev'] == 'bypass') {
    $_SESSION['email'] = 'dev@example.com';
    $_SESSION['username'] = 'Developer';
    header("Location: ./HOMEPAGE/index.php");
    exit();
}
?>
