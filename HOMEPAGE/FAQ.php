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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barangay Kalawaan</title>
    <link rel="stylesheet" href="homepage_styles.css" />
    <link rel="stylesheet" href="FAQ.CSS" />
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  </head>

  <body>
 <!-- Sidebar structure -->
<div class="sidebar collapsed" id="sidebar">
<div>
<div class="logo"><img src="logo.png" alt=""></div>
        
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


    <section class="faq-section">
      <h1>Frequently Asked Questions</h1>

      <div class="faq-controls">
        <button id="expand-all">Expand All</button>
        <button id="collapse-all">Collapse All</button>
      </div>

      <div class="faq-container">
        <div
          class="faq-box"
          data-question="Anu-ano ang kailangan sa pagkuha ng Barangay Clearance?"
        >
          <div class="faq-question">
            Ano-ano ang kailangan sa pagkuha ng Barangay Clearance?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Una kailangan mo ng valid ID, proof of residence, at mag filled-out
            ng barangay clearance form para matapos ang proseso.
          </div>
        </div>
        <div class="faq-box" data-question="Paano kumuha ng Business permit?">
          <div class="faq-question">
            Paano kumuha ng Business permit?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Ang requirements para makakuha ng Business Permit ay DTI
            registration, barangay clearance, proof of address, and payment of
            the necessary fees.
          </div>
        </div>

        <div
          class="faq-box"
          data-question="Paano kumuha ng Barangay Indigency Certificate?"
        >
          <div class="faq-question">
            Paano kumuha ng Barangay Indigency Certificate?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Upang makakuha ng Barangay Indigency Certificate, kailangan mo muna
            fill up ang form pati presenta ang valid ID. Itong certificate ay
            kalimitan kailangan pagkukuha ng Ayuda.
          </div>
        </div>
        <div
          class="faq-box"
          data-question="Ano ang mga dokumento na kailangan sa pag-apply ng trabaho?"
        >
          <div class="faq-question">
            Ano ang mga dokumento na kailangan sa pagkuha ng Barangay Clearance?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Kailangan mo lang ng valid ID at mag fill up ng form.
          </div>
        </div>
        <div
          class="faq-box"
          data-question="Paano mag-apply para sa Barangay ID?"
        >
          <div class="faq-question">
            May bayad ba ang pagkuha ng mga dokumento?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Sa ngayon ay libre lang ang aming serbisyo mag filled up lang sa
            gustong mong kunin dokumento para agad itong maproseso.
          </div>
        </div>
        <div
          class="faq-box"
          data-question="Paano magparehistro ng bagong negosyo?"
        >
          <div class="faq-question">
            Paano magparehistro ng bagong negosyo?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Kung nais mo mag parehistro ng negosyo kailangan mo ng DTI
            Registration,at Barangay clearance.
          </div>
        </div>
        <div
          class="faq-box"
          data-question="Paano magparehistro ng bagong negosyo?"
        >
          <div class="faq-question">
            Anong araw open ang Barangay sa pagkuha ng mga dokumento?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            Lunes haggang Biyernes sa ganap na 6:00am ng umaga at nagtatapos ng
            5pm ng gabi.
          </div>
        </div>
        <div
          class="faq-box"
          data-question="Paano magparehistro ng bagong negosyo?"
        >
          <div class="faq-question">
            Ilang araw bago maproseso ang aking mga dokumento?
            <span class="icon">+</span>
          </div>
          <div class="faq-answer">
            3 to 5 days upang maproseso ang iyong dokumento.
          </div>
        </div>
      </div>
    </section> 
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


    <script src="faq.js"></script>
    <script src="homepage.js"></script>
  </body>
</html>
