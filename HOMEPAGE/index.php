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
<script>
    // Define `isLoggedIn` for JavaScript
    var isLoggedIn = <?php echo $isLoggedIn; ?>;
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Kalawaan</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // JavaScript variable to check user login status
        var isLoggedIn = <?php echo json_encode($userLoggedIn); ?>;
    </script>
</head>
<body>

<!-- Sidebar structure -->
<div class="sidebar collapsed" id="sidebar">
<div>
    <div class="logo"><img src="logo.png" alt=""></div>

    <a href="../HOMEPAGE/index.php">
      <div class="menu-item" data-tooltip="Home">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
      </div>
    </a>
    <a href="../HOMEPAGE/registration.php">
      <div class="menu-item" data-tooltip="Register">
        <i class="fas fa-chart-bar"></i>
        <span>Register</span>
      </div>
    </a>
    <a href="../HOMEPAGE/FAQ.php">
      <div class="menu-item" data-tooltip="FAQs">
        <i class="fas fa-folder"></i>
        <span>FAQs</span>
      </div>
    </a>
    <a href="../QUEUE/Queue.php">
      <div class="menu-item" data-tooltip="Queue">
        <i class="fa-solid fa-users-line"></i>
        <span>Queue</span>
      </div>
    </a>
    <a href="../HOMEPAGE/user.php">
      <div class="menu-item" data-tooltip="Profile">
        <i class="fa-solid fa-user"></i>
        <span>Profile</span>
      </div>
    </a>
    <a href="../LOGIN&SIGNUP/logout.php">
      <div class="menu-item" data-tooltip="Logout" style="color: #408140;">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
      </div>
    </a>
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

<section id="home">
  <div class="image-slider">
    <div class="slides" id="slides">
      <img src="im1.jpg" alt="Image 1" />
      <img src="brgy.jpg" alt="Image 2" />
      <img src="im2.jpg" alt="Image 3" />
      <img src="im3.jpg" alt="Image 4" />
      <img src="im4.jpg" alt="Image 5" />
      <img src="im5.jpg" alt="Image 6" />
      <img src="im6.jpg" alt="Image 7" />
      <img src="im7.jpg" alt="Image 8" />
      <img src="im8.jpg" alt="Image 9" />
      <img src="im1.jpg" alt="Image 10" />
      <img src="brgy.jpg" alt="Image 11" />
      <img src="im2.jpg" alt="Image 12" />
      <img src="im3.jpg" alt="Image 13" />
      <img src="im4.jpg" alt="Image 14" />
      <img src="im5.jpg" alt="Image 15" />
      <img src="im6.jpg" alt="Image 16" />
      <img src="im7.jpg" alt="Image 17" />
      <img src="im8.jpg" alt="Image 18" />
      <img src="im1.jpg" alt="Image 19" />
      <img src="brgy.jpg" alt="Image 20" />
      <img src="im2.jpg" alt="Image 21" />
      <img src="im3.jpg" alt="Image 22" />
      <img src="im4.jpg" alt="Image 23" />
      <img src="im5.jpg" alt="Image 24" />
      <img src="im6.jpg" alt="Image 25" />
      <img src="im7.jpg" alt="Image 26" />
      <img src="im1.jpg" alt="Image 27" />
      <img src="im4.jpg" alt="Image 27" />
      <img src="im3.jpg" alt="Image 27" />
    </div>
    <span class="slider-btn left" onclick="prevSlide()">&#10094;</span>
    <span class="slider-btn right" onclick="nextSlide()">&#10095;</span>
  </div>
<script src="slider.js"></script>
</section>
    <div class="news-container">
      <div class="news-item">
        <img src="volley.jpg" alt="News Image 1">
        <div class="news-content">
          <h2 class="news-title">SK Kalawaan Volleyball League 2024</h2>
          <p class="news-description">Ang pasahan ng requirements para sa SK Kalawaan Volleyball League 2024 ay muli pong ie-extended hanggang October 15, 2024 (Tuesday). Para sa mga nais humabol sa 𝗪𝗢𝗠𝗘𝗡'𝗦 𝗗𝗜𝗩𝗜𝗦𝗜𝗢𝗡 (𝟭𝟮-𝟭𝟳 at 𝟭𝟴-𝟮𝟱 𝘆𝗲𝗮𝗿𝘀 𝗼𝗹𝗱) ng liga, maaari pa rin po kayong kumuha ng form sa SK Office simula 12:00 PM araw-araw.</p>
          <a href="https://www.facebook.com/KalawaanSK/posts/122173535792134374" class="news-readmore">Read More</a>
        </div>
      </div>
    
      <div class="news-item">
        <img src="basketball.jpg" alt="News Image 2">
        <div class="news-content">
          <h2 class="news-title">Pusong kalaweno, Laging Panalo!</h2>
          <p class="news-description">Panalo ang Barangay Kalawaan kontra sa Barangay San Antonio noong September 7 at Barangay Malinao noong September 8, 2024 para sa Basketball. Tagumpay rin ang ating representatives sa Men's Volleyball Division laban sa Barangay Sta. Rosa noong September 7, 2024. Samantala, patuloy na nagpapakita ng lakas at determinasyon ang ating Women's Volleyball Division para makamit ang ating unang panalo. </p>
          <a href="https://www.facebook.com/KalawaanSK/posts/122168583380134374" class="news-readmore">Read More</a>
        </div>
      </div>
      
      <!-- Add more news items as needed -->
    </div>
    <section class="mission-vision" id="mission-vision">
      <div class="mission-container">
        <div class="text-block mission">
          <h3>Mission</h3>
          <p>
            Barangay Kalawaan envisions itself as a progressive, peaceful, and
            environmentally sustainable community where residents enjoy a high
            quality of life, access to essential services, and a strong sense of
            unity and cooperation.
          </p>
        </div>
        <div class="text-block vision">
          <h3>Vision</h3>
          <p>
            Barangay Kalawaan envisions itself as a progressive, peaceful, and
            environmentally sustainable community where residents enjoy a high
            quality of life, access to essential services, and a strong sense of
            unity and cooperation.
          </p>
        </div>
      </div>
    </section>
  
    <section class="services">
  <h2>Our Services</h2>
  <div class="service-cards">
    <div class="service-card" id="serviceBusinessPermit">
      <h3>Barangay Business Permit&nbsp;</h3>
      <span class="toggle-icon"></span>
      <p>
        Apply for a Barangay Business Permit to register your local business.
      </p>
      <div class="more-info">
        <h4>Requirements:</h4>
        <div class="requirements">
          <div class="requirement">Completed Application Form</div>
          <div class="divider"></div>
          <div class="requirement">DTI/SEC Registration (if applicable)</div>
          <div class="divider"></div>
          <div class="requirement">
            Proof of Address (e.g., Utility Bill or Lease Contract)
          </div>
          <div class="divider"></div>
          <div class="requirement">Community Tax Certificate (Cedula)</div>
          <div class="divider"></div>
          <div class="requirement">Barangay Clearance</div>
        </div>
      </div>
    </div>

    <div class="service-card" id="serviceIndigencyCert">
      <h3>Barangay Certificate of Indigency</h3>
      <span class="toggle-icon"></span>
      <p>
        Request a Certificate of Indigency to avail government services for
        low-income residents.
      </p>
      <div class="more-info">
        <h4>Requirements:</h4>
        <div class="requirements">
          <div class="requirement">Valid ID or any Government-Issued ID</div>
          <div class="divider"></div>
          <div class="requirement">
            Proof of Residency (Barangay ID or Utility Bill)
          </div>
          <div class="divider"></div>
          <div class="requirement">
            Affidavit of No Income or Proof of Low Income
          </div>
          <div class="divider"></div>
          <div class="requirement">Community Tax Certificate (Cedula)</div>
        </div>
      </div>
    </div>

    <div class="service-card" id="serviceClearance">
      <h3>Barangay Clearance</h3>
      <span class="toggle-icon"></span>
      <p>Obtain your Barangay Clearance for legal and official purposes.</p>
      <div class="more-info">
        <h4>Requirements:</h4>
        <div class="requirements">
          <div class="requirement">
            Valid ID (Government-Issued ID preferred)
          </div>
          <div class="divider"></div>
          <div class="requirement">Community Tax Certificate (Cedula)</div>
          <div class="divider"></div>
          <div class="requirement">
            Proof of Residency (Barangay ID or Utility Bill)
          </div>
          <div class="divider"></div>
          <div class="requirement">
            Application Fee (based on local regulations)
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  
    <section class="map-container">
      <div id="map"></div>
      <script src="map.js"></script>
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

<!-- Chatbox button -->
<button class="chat-toggle" onclick="toggleChat()">💬</button>

<!-- Chatbox structure -->
<div class="chatbox" id="chatbox" style="display: none;">
  <div class="chatbox-header" id="chatbox-header">
    <img src="logo.png" alt="Chatbot Logo" />
    <span>Chatbot Support</span>
  </div>

  <div class="chatbox-content" id="chatbox-content">
    <p class="message">Hey 👋 Got any questions?</p>
    <p class="message">Please choose your language:</p>

    <!-- Language Selection -->
    <div class="language-selection">
      <button onclick="selectLanguage('english')">English</button>
      <button onclick="selectLanguage('tagalog')">Tagalog</button>
    </div>

    <!-- English Questions -->
    <div id="english-questions" style="display: none;">
      <p class="message">How can I help you?</p>
      <button onclick="sendMessage('What are the steps to apply for a Barangay Business Permit?')">
        What are the steps to apply for a Barangay Business Permit?
      </button>
      <button onclick="sendMessage('Can I renew my Barangay Business Permit online?')">
        Can I renew my Barangay Business Permit online?
      </button>
      <button onclick="sendMessage('What should I do if my Barangay Clearance, Business Permit, and Certificate of Indigency has expired?')">
        What should I do if my Barangay Clearance, Business Permit, and Certificate of Indigency has expired?
      </button>
      <button onclick="sendMessage('What documents do I need for a Certificate of Indigency?')">
        What documents do I need for a Certificate of Indigency?
      </button>
      <button onclick="sendMessage('How long is a Certificate of Indigency valid?')">
        How long is a Certificate of Indigency valid?
      </button>
    <button onclick="sendMessage('Do I need to renew my Barangay Clearance every year?')">
     Do I need to renew my Barangay Clearance every year?
   </button>
    <button onclick="sendMessage('What happens if I lose my Barangay Clearance, Business Permit, and Certificate of Indigency?')">
     What happens if I lose my Barangay Clearance, Business Permit, and Certificate of Indigency?
    </button>
    <button onclick="sendMessage('Is there a fee for the reissuance of a lost Barangay Clearance, Business Permit, and Certificate of Indigency?')">
     Is there a fee for the reissuance of a lost Barangay Clearance, Business Permit, and Certificate of Indigency?
   </button>
    <button onclick="sendMessage('What is the difference between a Barangay Business Permit and a Barangay Clearance?')">
     What is the difference between a Barangay Business Permit and a Barangay Clearance?
   </button>
    </div>

    <!-- Tagalog Questions -->
    <div id="tagalog-questions" style="display: none;">
      <p class="message">Paano kita matutulungan?</p>
      <button onclick="sendMessage('Gaano katagal valid ang Certificate of Indigency?')">
        Gaano katagal valid ang Certificate of Indigency?
      </button>
      <button onclick="sendMessage('Kailangan ko bang i-renew ang Barangay Clearance bawat taon?')">
        Kailangan ko bang i-renew ang Barangay Clearance bawat taon?
      </button>
      <button onclick="sendMessage('Ano ang mga hakbang sa pag-apply ng Barangay Business Permit?')">
        Ano ang mga hakbang sa pag-apply ng Barangay Business Permit?
      </button>
      <button onclick="sendMessage('May bayad ba ang reissuance ng nawalang Barangay Clearance, Business Permit, at Certificate of Indigency?')">
       May bayad ba ang reissuance ng nawalang Barangay Clearance, Business Permit, at Certificate of Indigency?
     </button>
      <button onclick="sendMessage('Ano ang pagkakaiba ng Barangay Business Permit at Barangay Clearance?')">
       Ano ang pagkakaiba ng Barangay Business Permit at Barangay Clearance?
     </button>
      <button onclick="sendMessage('Ano ang mga hakbang sa pag-apply ng Barangay Business Permit?')">
       Ano ang mga hakbang sa pag-apply ng Barangay Business Permit?
     </button>
      <button onclick="sendMessage('Puwede ko bang i-renew ang Barangay Business Permit online?')">
       Puwede ko bang i-renew ang Barangay Business Permit online?
     </button>
      <button onclick="sendMessage('Ano ang dapat gawin kung nag-expire ang aking Barangay Clearance, Business Permit, at Certificate of Indigency?')">
       Ano ang dapat gawin kung nag-expire ang aking Barangay Clearance, Business Permit, at Certificate of Indigency?
     </button>
      <button onclick="sendMessage('Ano ang mga dokumento na kailangan para sa Certificate of Indigency?')">
       Ano ang mga dokumento na kailangan para sa Certificate of Indigency?
     </button>
    </div>
  </div>

  <!-- Chatbox Footer -->
  <div class="chatbox-footer">
    <input type="text" id="userInput" placeholder="Type a message" />
    <button onclick="handleUserInput()">&#x27A4;</button>
  </div>
</div>

 
<script src="homepage.js"></script>
 <script src="chatbot.js"></script>
 
</body>

</html>
