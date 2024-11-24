document.getElementById('resetPasswordForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting traditionally

    const formData = new FormData(this);
    const newPassword = formData.get('new_password');
    const confirmPassword = formData.get('confirm_password');
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');

    // Clear any previous alerts
    successAlert.classList.remove('show');
    errorAlert.classList.remove('show');

    // Password validation: Must have at least one uppercase and one lowercase letter, 6 characters minimum
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

    if (!passwordRegex.test(newPassword)) {
        errorAlert.textContent = '✘ Error: Password must contain at least one uppercase and one lowercase letter.';
        errorAlert.classList.add('show');
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 3000);
        return; // Stop form submission
    }

    // Client-side validation: Check if passwords match
    if (newPassword !== confirmPassword) {
        errorAlert.textContent = '✘ Error: Passwords do not match.';
        errorAlert.classList.add('show');
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 3000);
        return; // Stop form submission
    }

    // If validation passes, send the form data to the server using fetch
    fetch('resetpass.php', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        if (data.status === 'success') {
            successAlert.textContent = data.message;
            successAlert.classList.add('show');
            setTimeout(function () {
                successAlert.classList.remove('show');
                window.location.href = 'adminLogin.php'; // Redirect to login page after 3 seconds
            }, 3000);
        } else {
            errorAlert.textContent = data.message;
            errorAlert.classList.add('show');
            setTimeout(function () {
                errorAlert.classList.remove('show');
            }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorAlert.textContent = '✘ Error: Unable to process your request.';
        errorAlert.classList.add('show');
        setTimeout(function () {
            errorAlert.classList.remove('show');
        }, 3000);
    });
});
