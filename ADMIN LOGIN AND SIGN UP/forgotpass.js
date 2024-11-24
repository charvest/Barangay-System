document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent page refresh
    let email = event.target.email.value.trim();

    // Sanitize email input (basic sanitization)
    email = email.replace(/[^\w@.-]/gi, '');

    // Clear any existing alerts before the request is sent
    document.getElementById('successAlert').classList.remove('show');
    document.getElementById('errorAlert').classList.remove('show');

    // Show "Sending OTP..." immediately after form validation
    document.getElementById('successAlert').textContent = "Sending OTP...";
    document.getElementById('successAlert').classList.add('show');

    // Send the request to the backend
    fetch('sendmail.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            email: email
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update the message to "OTP sent successfully!" once the OTP is sent
            document.getElementById('successAlert').textContent = data.message;

            // Optionally hide the success alert after 3 seconds and redirect to otpverify.html
            setTimeout(function() {
                document.getElementById('successAlert').classList.remove('show');
                window.location.href = 'otpverify.php';  // Redirect to OTP verification page
            }, 3000);
        } else {
            // Hide "Sending OTP..." and show error alert if there's an error (e.g., email not found)
            document.getElementById('successAlert').classList.remove('show');
            document.getElementById('errorAlert').textContent = data.message;
            document.getElementById('errorAlert').classList.add('show');

            // Hide the error alert after 3 seconds
            setTimeout(function() {
                document.getElementById('errorAlert').classList.remove('show');
            }, 3000);
        }
    })
    .catch(error => {
        // Handle unexpected errors (network failure, etc.)
        document.getElementById('successAlert').classList.remove('show'); // Hide "Sending OTP..."
        document.getElementById('errorAlert').textContent = 'Error: Unable to process your request.';
        document.getElementById('errorAlert').classList.add('show');

        // Hide the error alert after 3 seconds
        setTimeout(function() {
            document.getElementById('errorAlert').classList.remove('show');
        }, 3000);
        console.error('Error:', error);
    });
});
