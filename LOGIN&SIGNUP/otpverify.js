document.querySelectorAll('.otp').forEach((input, index, inputs) => {
    input.addEventListener('input', function () {
        // Sanitize input to allow only numbers
        this.value = this.value.replace(/\D/g, '');

        // If the current input has a value and is a digit, move to the next one
        if (this.value.length === this.maxLength) {
            const nextInput = inputs[index + 1];
            if (nextInput) {
                nextInput.focus();
            }
        }
    });

    input.addEventListener('keydown', function (event) {
        // If the backspace key is pressed, move to the previous input
        if (event.key === 'Backspace' && this.value.length === 0) {
            const previousInput = inputs[index - 1];
            if (previousInput) {
                previousInput.focus();
            }
        }
    });
});

// Prevent form submission and handle OTP verification using AJAX
document.getElementById('otpVerifyForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const form = new FormData(this);

    // Sanitize each OTP digit (allow only numeric characters)
    for (let pair of form.entries()) {
        form.set(pair[0], pair[1].replace(/\D/g, ''));  // Remove non-numeric characters
    }

    // Send the form data to the server using Fetch API
    fetch('verifyotp.php', {
        method: 'POST',
        body: form
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Show success alert
            const successAlert = document.getElementById('successAlert');
            successAlert.classList.add('show');
            document.getElementById('errorAlert').classList.remove('show');

            // Redirect to resetpass.html after 3 seconds
            setTimeout(function () {
                successAlert.classList.remove('show');
                window.location.href = 'resetpassword.php';  // Redirect to password reset page
            }, 3000);
        } else {
            // Show error alert
            const errorAlert = document.getElementById('errorAlert');
            errorAlert.classList.add('show');
            document.getElementById('successAlert').classList.remove('show');

            // Hide the error alert after 3 seconds
            setTimeout(function () {
                errorAlert.classList.remove('show');
            }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Show generic error alert
        const errorAlert = document.getElementById('errorAlert');
        errorAlert.classList.add('show');
        document.getElementById('successAlert').classList.remove('show');

        // Hide the error alert after 3 seconds
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 3000);
    });
});
