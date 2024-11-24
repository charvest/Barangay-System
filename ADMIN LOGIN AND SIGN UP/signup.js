document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from refreshing the page

    const formData = new FormData(this); // Capture form data
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    const alertBox = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    const form = this; // Reference to the form

    // Password regex validation (at least one uppercase and one lowercase letter, no need for special characters or numbers)
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

    if (!passwordRegex.test(password)) {
        errorAlert.textContent = '✘ Error: Password must contain at least one uppercase and one lowercase letter.'; // Error message for password validation
        errorAlert.style.color = 'red'; // Red text for error
        errorAlert.classList.add('show'); // Show the error alert

        // Remove the error alert after 3 seconds
        setTimeout(function() {
            errorAlert.classList.remove('show');
        }, 3000); // 3000ms = 3 seconds
        return; // Stop form submission
    }

    // Client-side validation: Check if passwords match
    if (password !== confirmPassword) {
        errorAlert.textContent = '✘ Error: Passwords do not match.'; // Error message for passwords not matching
        errorAlert.style.color = 'red'; // Red text for error
        errorAlert.classList.add('show'); // Show the error alert

        // Remove the error alert after 3 seconds
        setTimeout(function() {
            errorAlert.classList.remove('show');
        }, 3000); // 3000ms = 3 seconds
        return; // Stop form submission
    }

    // Proceed with form submission after successful validation
    fetch('admin_Signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result.includes('success')) { // Check if response contains 'success'
            alertBox.textContent = '✔ Success! Sign up successful.'; // Success message
            alertBox.style.color = '#28a745'; // Green text for success
            alertBox.classList.add('show'); // Show the alert

            // Remove the success alert after 3 seconds and redirect to the login page
            setTimeout(function() {
                alertBox.classList.remove('show');
                form.reset(); // Clear the form after success
                window.location.href = "adminLogin.php"; // Redirect to Login.html after 3 seconds
            }, 3000); // 3000ms = 3 seconds
        } else if (result.includes('username_taken')) {
            errorAlert.textContent = '✘ Error: Username is already taken.'; // Error message for username taken
            errorAlert.style.color = 'red'; // Red text for error
            errorAlert.classList.add('show'); // Show the error alert

            // Remove the error alert after 3 seconds
            setTimeout(function() {
                errorAlert.classList.remove('show');
            }, 3000); // 3000ms = 3 seconds
        } else if (result.includes('email_taken')) {
            errorAlert.textContent = '✘ Error: Email is already taken.'; // Error message for email taken
            errorAlert.style.color = 'red'; // Red text for error
            errorAlert.classList.add('show'); // Show the error alert

            // Remove the error alert after 3 seconds
            setTimeout(function() {
                errorAlert.classList.remove('show');
            }, 3000); // 3000ms = 3 seconds
        } else {
            errorAlert.textContent = '✘ Error: Something went wrong. Please try again.'; // General error message
            errorAlert.style.color = 'red'; // Red text for error
            errorAlert.classList.add('show'); // Show the error alert

            // Remove the error alert after 3 seconds
            setTimeout(function() {
                errorAlert.classList.remove('show');
            }, 3000); // 3000ms = 3 seconds
        }
    })
    .catch(error => {
        errorAlert.textContent = '✘ Error: Request failed.'; // General error message for request failures
        errorAlert.style.color = 'red'; // Red text for error
        errorAlert.classList.add('show'); // Show the error alert

        // Remove the error alert after 3 seconds
        setTimeout(function() {
            errorAlert.classList.remove('show');
        }, 3000); // 3000ms = 3 seconds

        console.error('Request failed:', error);
    });
});


