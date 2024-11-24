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
    var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Kalawaan</title>
    <script src="homepage.js"></script>
    <script src="registration.js"></script>
    <link rel="stylesheet" href="registration.css">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  
  <div class="container">
        <h2>Select the Type of Registration</h2>
        <div class="form-selection">
            <button id="indigency-btn">Certificate of Indigency</button>
            <button id="clearance-btn">Barangay Clearance</button>
            <button id="permit-btn">Business Permit</button>
        </div>

        <form id="indigency-form" class="form-container" method="POST" action="submit_indigency.php" enctype="multipart/form-data">
            <center><h3>Certificate of Indigency</h3></center>
            <div class="form-group">
                <label for="indigency-fname">Full Name</label> 
                <input type="text" id="indigency-fname" name="fullname" placeholder="Enter your full name" required>
                <label for="indigency-age">Age</label>
                <input type="number" id="indigency-age" name="age" placeholder="Enter your age" min="1" required>
                <label for="indigency-gender">Gender</label>
            <select id="indigency-gender" name="gender" required>
                <option value="" disabled selected>Select your gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label for="indigency-contact">Contact Number</label>
            <input type="number" id="indigency-contact" name="contact_number" placeholder="Enter your contact number" required>
            <label for="indigency-availability">Availability</label>
        <select id="indigency-availability" name="availability" required>
            <option value="" disabled selected>Select availability</option>
            <option value="AM">(7:00 - 11:00 AM)</option>
            <option value="PM">(1:00 - 5:00 PM) </option>
        </select>    
            <label for="indigency-email">Email</label>
                <input type="email" id="indigency-email" name="email" placeholder="Enter your email" required>
                <label for="years-in">Years in Kalawaan</label>
                <input type="number" id="years-in" name="years_in_kalawaan" placeholder="Enter your years in Kalawaan" min="1" required>
                
            </div>
            <div class="form-group">
                <label for="indigency-address">Address</label>
                <input type="text" id="indigency-address" name="address" placeholder="Enter your address" required>
            </div>
            
            <h3><label for="indigency-marital-status">Marital Status</label></h3>
            <select id="indigency-marital-status" name="marital_status" required>
                <option value="" disabled selected>Select your Marital Status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>
            <div class="form-group">
                <label for="indigency-pwd">Are you a Person with Disability (PWD) or a Senior Citizen? </label>
                <div class="radio-group">
                    <label class="custom-radio">
                        <input type="radio" id="indigency-pwd-yes" name="pwd" value="yes" required>
                        <span class="radio-label">Yes</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" id="indigency-pwd-no" name="pwd" value="no" required>
                        <span class="radio-label">No</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="indigency-reason">Reason for Request</label>
                <textarea id="indigency-reason" name="reason_for_request" placeholder="Why do you need a Certificate of Indigency?" required></textarea>
            </div>
            <div class="file-upload">
                <div class="file-buttons">
                    <label for="indigency-id-front">Upload ID Front</label>
                    <input type="file" id="indigency-id-front" name="front_of_id" accept=".jpg,.jpeg,.png" required>
            
                    <label for="indigency-id-back">Upload ID Back</label>
                    <input type="file" id="indigency-id-back" name="back_of_id" accept=".jpg,.jpeg,.png" required>
                </div>
                
                <div class="file-previews">
                    <div class="file-preview" id="indigency-preview-front">
                        <img src="" alt="ID Front Preview">
                        <div class="error" id="indigency-error-front"></div>
                    </div>
                    
                    <div class="file-preview" id="indigency-preview-back">
                        <img src="" alt="ID Back Preview">
                        <div class="error" id="indigency-error-back"></div>
                    </div>
                </div>
            </div>
            
            <button id="indigency-submit" class="submit-btn">Submit</button>
        </form>


        <form id="clearance-form" class="form-container" method="POST" action="submit_clearance.php" enctype="multipart/form-data">
            <center><h3>Barangay Clearance</h3></center>
            <div class="form-group">
                <label for="clearance-fname">Full Name</label> 
                <input type="text" id="clearance-fname" name="fname" placeholder="Enter your Full Name" required>
                <label for="clearance-age">Age</label>
                <input type="number" id="clearance-age" name="age" placeholder="Enter your age" min="1" required>
                <label for="clearance-address">Address</label>
                <input type="text" id="clearance-address" name="address" placeholder="Enter your address" required>
                <label for="clearance-contact">Contact Number</label>
                <input type="number" id="clearance-contact" name="contact_number" placeholder="Enter your contact number" required>
                <label for="clearance-availability">Availability</label>
                <select id="clearance-availability" name="availability" required>
                    <option value="" disabled selected>Select availability</option>
                    <option value="AM">(7:00 - 11:00 AM)</option>
                    <option value="PM">(1:00 - 5:00 PM)</option>
                </select>
                <label for="clearance-email">Email</label>
                <input type="email" id="clearance-email" name="email" placeholder="Enter your email" required>    
            </div>
            <h3><label for="clearance-gender">Gender</label></h3>
            <select id="clearance-gender" name="gender" required>
                <option value="" disabled selected>Select your given gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <h3><label for="clearance-marital-status">Marital Status</label></h3>
            <select id="clearance-marital-status" name="marital-status" required>
                <option value="" disabled selected>Select your Marital Status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>
            <div class="form-group">
                <label for="clearance-pwd">Are you a Person with Disability (PWD) or a Senior Citizen?</label>
                <div class="radio-group">
                    <label class="custom-radio">
                        <input type="radio" id="clearance-pwd-yes" name="clearance-pwd" value="yes" required>
                        <span class="radio-label">Yes</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" id="clearance-pwd-no" name="clearance-pwd" value="no" required>
                        <span class="radio-label">No</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="clearance-purpose">Purpose of Clearance</label>
                <textarea id="clearance-purpose" name="purpose" placeholder="Why do you need Barangay Clearance?" required></textarea>
            </div>
            <div class="file-upload">
                <input type="file" id="clearance-id-front" name="clearance-id-front" accept=".jpg,.jpeg,.png" required>
                <input type="file" id="clearance-id-back" name="clearance-id-back" accept=".jpg,.jpeg,.png" required>
                <label for="clearance-id-front">Upload ID Front</label>
                <label for="clearance-id-back">Upload ID Back</label>
                <div class="file-preview" id="clearance-preview-front">
                    <img src="" alt="ID Front Preview">
                    <div class="error" id="clearance-error-front"></div>
                </div>
                <div class="file-preview" id="clearance-preview-back">
                    <img src="" alt="ID Back Preview">
                    <div class="error" id="clearance-error-back"></div>
                </div>
            </div>
            <button id="clearance-submit" class="submit-btn">Submit</button>
        </form>        

        <form id="permit-form" class="form-container" method="POST" action="submit_permit.php" enctype="multipart/form-data">
            <center><h3>Business Permit</h3></center>
            <div class="form-group">
                <label for="permit-fullname">Full Name</label> 
                <input type="text" id="permit-fullname" name="fullname" placeholder="Enter your full name" required>
                
                <label for="permit-age">Age</label>
                <input type="number" id="permit-age" name="age" placeholder="Enter your age" min="1" required>
                
                <label for="permit-gender">Gender</label>
                <select id="permit-gender" name="gender" required>
                    <option value="" disabled selected>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
        
                <label for="permit-contact">Contact Number</label>
                <input type="text" id="permit-contact" name="contact_number" placeholder="Enter your contact number" required>

                <label for="permit-availability">Availability</label>
                <select id="permit-availability" name="availability" required>
                    <option value="" disabled selected>Select availability</option>
                    <option value="AM">(7:00 - 11:00 AM)</option>
                    <option value="PM">(1:00 - 5:00 PM)</option>
                </select>

                <label for="permit-email">Email</label>
                <input type="email" id="permit-email" name="email" placeholder="Enter your email" required>

        
                <label for="business-address">Business Address</label>
                <input type="text" id="business-address" name="address" placeholder="Enter the business address" required>
                
                <label for="occupation">Occupation</label>
                <input type="text" id="occupation" name="occupation" placeholder="Enter your occupation" required>
            </div>
            <div class="form-group">
                <label for="permit-pwd">Are you a Person with Disability (PWD) or a Senior Citizen?</label>
                <div class="radio-group">
                    <label class="custom-radio">
                        <input type="radio" id="permit-pwd-yes" name="permit-pwd" value="yes" required>
                        <span class="radio-label">Yes</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" id="permit-pwd-no" name="permit-pwd" value="no" required>
                        <span class="radio-label">No</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="permit">Purpose of permit</label>
                <textarea id="permit-purpose" name="purpose" placeholder="Why do you need a Business Permit?" required></textarea>
            </div>
            <div class="file-upload">
                <input type="file" id="permit-id-front" name="permit-id-front" accept=".jpg,.jpeg,.png" required>
                <input type="file" id="permit-id-back" name="permit-id-back" accept=".jpg,.jpeg,.png" required>
                <label for="permit-id-front">Upload ID Front</label>
                <label for="permit-id-back">Upload ID Back</label>
                <div class="file-preview" id="permit-preview-front">
                    <img src="" alt="ID Front Preview">
                    <div class="error" id="permit-error-front"></div>
                </div>
                <div class="file-preview" id="permit-preview-back">
                    <img src="" alt="ID Back Preview">
                    <div class="error" id="permit-error-back"></div>
                </div>
            </div>
            
            <button id="permit-submit" class="submit-btn">Submit</button>
        </form>         
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

    
    </body>
    
    
</body>
</html>