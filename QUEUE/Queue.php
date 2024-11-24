 
<?php
session_start();

include('../LOGIN&SIGNUP/dbconfig.php');  // Include database configuration

$userLoggedIn = false;
$username = '';

if (isset($_SESSION['email'])) {
    $userLoggedIn = true;
    $username = $_SESSION['username'];  // Assuming you store username in session
}
// Check if 'username' is set in the session. If not, use 'Guest' as the default.
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';



 

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Show SweetAlert with custom font and redirect to login page
    echo "
    <style>
        /* Customize SweetAlert font */
        .swal2-popup {
            font-family: 'Arial', sans-serif;  /* Change to your preferred font */
            font-size: 16px;  /* Optional: adjust font size */
        }
    </style>

    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Access Denied',
                text: 'You must be logged in to access the queue.',
                icon: 'warning',
                confirmButtonText: 'Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../LOGIN&SIGNUP/Loginpage.php';
                }
            });
        });
    </script>
    ";
    exit;
}
?>

<script>
    // Define `isLoggedIn` for JavaScript
    var isLoggedIn = <?php echo $isLoggedIn; ?>;
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../HOMEPAGE/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="queue.css">
    
</head>
<body>
<!-- Sidebar structure -->
<div class="sidebar collapsed" id="sidebar">
<div>
<div class="logo"><img src="../HOMEPAGE/logo.png" alt=""></div>
        
        <a href="../HOMEPAGE/index.php">
            <div class="menu-item">
            <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </div>
        </a>
        <a href="../HOMEPAGE/registration.php">
            <div class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Register</span>
            </div>
        </a>
        <a href="../HOMEPAGE/FAQ.php">
            <div class="menu-item">
                <i class="fas fa-folder"></i>
                <span>FAQs</span>
            </div>
        </a>
        <a href="../QUEUE/Queue.php">
            <div class="menu-item">
            <i class="fa-solid fa-users-line"></i>
                <span>Queue</span>
            </div>
        </a>
        <a href="../HOMEPAGE/user.php">
            <div class="menu-item">
                <i class="fas fa-tasks"></i>
                <span>Profile</span>
            </div>
        </a>
        
        <div class="menu-item" >
        <a href="../LOGIN&SIGNUP/logout.php"  style="color:#408140;"><i class="fa-solid fa-right-from-bracket"></i>
           <span>Logout</span>
        </div></a>
    </div>

  <div class="user-profile">
  <img src="<?php echo isset($_SESSION['profile_picture']) ? htmlspecialchars($_SESSION['profile_picture']) : 'https://via.placeholder.com/40'; ?>" alt="User" />
    <div class="user-info">
        <!-- Display the user's username from the session -->
        <?php if (isset($_SESSION['username'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span> <!-- Username -->
        <?php else: ?>
            <span>Guest</span> <!-- Default to "Guest" if not set -->
        <?php endif; ?>

        <!-- Display the user's email below the username -->
        <br />
        <?php if (isset($_SESSION['email'])): ?>
            <span style="font-size: 12px;"><?php echo htmlspecialchars($_SESSION['email']); ?></span> <!-- Email -->
        <?php else: ?>
            <span style="font-size: 14px;">Please login first</span> <!-- Default text if not set -->
        <?php endif; ?>
    </div>
</div>

</div>

  <!-- Navbar -->
 
     <div id="navbar">
        <div class="logo">
            
            <span>Barangay Kalawaan</span>
            <span class="openbtn" id="toggleBtn">&#9776;</span>
        </div>
        <div class="nav-buttons" style="<?php echo $userLoggedIn ? 'display: none;' : ''; ?>">
            <a href="../LOGIN&SIGNUP/loginpage.php" class="sign-in">Login</a>
            <a href="../LOGIN&SIGNUP/Signup.php" class="get-started">Sign Up</a>
        </div>
        </div>
 <div class="overlay" id="overlay"></div>

    <!-- Main Content Section -->
    <div class="main-content">
        <div class="header">
            <h2>Dashboard</h2>
            <div id="queueContentContainer"></div> <!-- This is where queueContent will load -->
        </div>
    </div>
    <footer id="footer">
  <div class="footer-container">
    <!-- Main Description -->
    <div class="footer-description">
      <div class="footerlogo1">
        <img src="../HOMEPAGE/logo1.png" alt="Logo" width="125px" height="125px">
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

  <!-- Floating Chatbox -->
   <button class="chat-toggle" onclick="toggleChat()">💬</button>
  
   <div class="chatbox" id="chatbox">
       <div class="chatbox-header">
           <img src="chatbotman.webp" alt="Sendible Logo">
           <span>Chatbot Assistant</span>
       </div>
       <div class="chatbox-content" id="chatbox-content">
           <p class="message">Hey 👋 Got any questions?</p>
           <p class="message">I'll be glad to assist! What can I help you with?</p>
           <button onclick="sendMessage('Sendible features & plans')">Sendible features & plans</button>
           <button onclick="sendMessage('I\'m already a customer')">I'm already a customer</button>
           <button onclick="sendMessage('Request a demo')">Request a demo</button>
       </div>
       <div class="chatbox-footer">
           <input type="text" id="userInput" placeholder="Type a message">
           <button onclick="handleUserInput()">&#x27A4;</button> <!-- Arrow button -->
       </div>
   </div>

   

   <script src="sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="queue.js"></script>
   
</body>
</html>
