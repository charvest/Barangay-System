<?php 
session_start();
include('../LOGIN&SIGNUP/dbconfig.php');  // Database connection

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);

    // Query to retrieve the user's profile data from `user_profile` table and the username from the `user` table
    $query = "
        SELECT up.fullname, u.username AS user_username, up.email, up.address, up.profile_picture 
        FROM user_profile up
        JOIN users u ON u.email = up.email
        WHERE up.email = ?";
    
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Database error: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = array_map(fn($value) => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), $result->fetch_assoc());
    } else {
        $defaultUsername = htmlspecialchars(explode('@', $email)[0], ENT_QUOTES, 'UTF-8');  
        $insertQuery = "INSERT INTO user_profile (email, username, fullname, address, profile_picture) VALUES (?, ?, '', '', '')";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ss", $email, $defaultUsername);
        $insertStmt->execute();

        $stmt->execute();
        $result = $stmt->get_result();
        $user = array_map(fn($value) => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), $result->fetch_assoc());
        $user['user_username'] = $defaultUsername;
    }

    $stmt->close();
} else {
    header("Location: ../LOGIN&SIGNUP/Loginpage.php");
    exit();
}

$_SESSION['profile_picture'] = $user['profile_picture'] ?? 'https://via.placeholder.com/100';
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="user.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
<!-- Navbar -->
<header>
  <nav class="navbar">
      <div class="logo">
          <img src="logo.png" alt="Logo">
          <span>Barangay Kalawaan</span>
      </div>
      <ul class="nav-links" id="nav-links">
          <li><a href="../HOMEPAGE/index.php">Home</a></li>
          <li><a href="../HOMEPAGE/registration.php">Registration</a></li>
          <li><a href="../HOMEPAGE/FAQ.php">FAQ's</a></li>
          <li><a href="../QUEUE/Queue.php">Queue</a></li>
          <li><a href="#footer">Contact Us</a></li>
      </ul>
      

        <!-- Show nav-buttons only if the user is not logged in -->
        <div class="nav-buttons" style="<?php echo isset($_SESSION['email']) ? 'display: none;' : ''; ?>">
            <a href="../LOGIN&SIGNUP/loginpage.php" class="sign-in">Login</a>
            <a href="../LOGIN&SIGNUP/Signup.php" class="get-started">Sign Up</a>
        </div>
  </nav>
</header>

<div class="container">
    <aside class="sidebar">
        <form id="profileForm" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="<?php echo !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture'], ENT_QUOTES, 'UTF-8') : 'https://via.placeholder.com/100'; ?>" alt="User Avatar" id="profile-preview">
                <input type="hidden" name="existing_profile_picture" value="<?php echo htmlspecialchars($user['profile_picture'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <button type="button" onclick="document.getElementById('profile_picture').click()">Change Profile Picture</button>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;" onchange="previewImage(event)">
            
            <h3 class="profile-name"><?php echo htmlspecialchars($user['user_username'] ?? 'Guest', ENT_QUOTES, 'UTF-8'); ?></h3>
            <ul class="sidebar-links">
            <li><a href="../HOMEPAGE/index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="../HOMEPAGE/registration.php"><i class="fas fa-briefcase"></i> Register</a></li>
                <li><a href="../HOMEPAGE/FAQ.php"><i class="fa-solid fa-circle-info"></i> Support</a></li>
                <li><a href="../LOGIN&SIGNUP/logout.php"><i class="fas fa-sign-out-alt"></i> Signout</a></li>
            </ul>
        </form>
    </aside>

    <main class="content">
        <div class="about">
            <h2>About</h2>
            <div class="info">
                <p><strong>Username:</strong> <span class="view-mode"><?php echo htmlspecialchars($user['user_username'] ?? 'Guest', ENT_QUOTES, 'UTF-8'); ?></span>
                <input class="edit-mode" type="text" name="username" value="<?php echo htmlspecialchars($user['user_username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="display:none;"></p>

                <p><strong>Fullname:</strong> <span class="view-mode"><?php echo htmlspecialchars($user['fullname'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                <input class="edit-mode" type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="display:none;"></p>

                <p><strong>Email:</strong> <span class="view-mode"><?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                <input class="edit-mode" type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="display:none;"></p>

                <p><strong>Address:</strong> <span class="view-mode"><?php echo htmlspecialchars($user['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
                <input class="edit-mode" type="text" name="address" value="<?php echo htmlspecialchars($user['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="display:none;"></p>
            </div>
            <button id="edit-btn" type="button" onclick="toggleEditMode()">Edit</button>
            <button id="update-btn" type="button" onclick="submitProfile()" style="display:none;">Save</button>
        </div>
    </main>
</div>

<footer id="footer">
  <div class="footer-container">
    <!-- Main Description -->
    <div class="footer-description">
      <div class="footerlogo1">
        <img src="logo1.png" alt="Logo" width="125px" height="125px">
      </div>
      <p>Kalawaan is a barangay in the city of Pasig. Its population as determined by the 2020 Census was 32,145. This represented 4.00% of the total population of Pasig.</p>
    </div>

    

  <!-- Contact Us Section -->
<div class="footer-links">
  <div class="footer-column">
    <h3>Contact Us</h3>
    <p><strong>Address:</strong> Barangay Kalawaan, Pasig City, Philippines</p>
    <p><strong>Phone:</strong> <a href="tel:09561234567">09561234567</a></p>
    <p><strong>Email:</strong> <a href="mailto:barangaykalawaan@gmail.com">barangaykalawaan@gmail.com</a></p>
    <div class="social-links">
      <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
        <i class="fa-brands fa-facebook"></i> Facebook
      </a>
      <a href="https://mail.google.com" target="_blank" aria-label="Gmail">
        <i class="fa-sharp fa-solid fa-envelope"></i> Gmail
      </a>
    </div>
  </div>
</div>


    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="footer-bottom-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Sitemap</a>
      </div>
      <p >© 2024 Barangay Kalawaan. All Rights Reserved.</p>
    </div>
  </div>
 
</footer>

<script src="user.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

