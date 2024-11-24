<?php
session_start();
session_unset();
session_destroy();
header("Location: ..\ADMIN LOGIN AND SIGN UP\adminLogin.php");  // Redirect to login page after logout
exit;
?>
