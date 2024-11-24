document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('signupForm');
    const passwordField = form.querySelector('[name="password"]');
    const confirmPasswordField = form.querySelector('[name="confirm_password"]');
    const usernameField = form.querySelector('[name="username"]');
    const emailField = form.querySelector('[name="email"]');
    const errorAlert = document.getElementById('errorAlert');

    // Password regex for validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

    // Validate password strength as the user types
    passwordField.addEventListener('input', function () {
        if (!passwordRegex.test(passwordField.value)) {
            errorAlert.textContent = '✘ Error: Password must contain at least one uppercase and one lowercase letter.';
            errorAlert.style.color = 'red';
            errorAlert.classList.add('show');
        } else {
            errorAlert.classList.remove('show');
        }
    });

    // Validate password match as the user types
    confirmPasswordField.addEventListener('input', function () {
        if (confirmPasswordField.value !== passwordField.value) {
            errorAlert.textContent = '✘ Error: Passwords do not match.';
            errorAlert.style.color = 'red';
            errorAlert.classList.add('show');
        } else {
            errorAlert.classList.remove('show');
        }
    });

    // Check username availability as the user types
    usernameField.addEventListener('input', function () {
        const username = usernameField.value;

        if (username.length > 0) {
            fetch('check_username.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.username_taken) {
                        errorAlert.textContent = '✘ Error: Username is already taken.';
                        errorAlert.style.color = 'red';
                        errorAlert.classList.add('show');
                    } else {
                        errorAlert.classList.remove('show');
                    }
                })
                .catch(error => console.error('Error checking username:', error));
        }
    });

    // Check email availability as the user types
    emailField.addEventListener('input', function () {
        const email = emailField.value;

        if (email.length > 0) {
            fetch('check_email.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.email_taken) {
                        errorAlert.textContent = '✘ Error: Email is already taken.';
                        errorAlert.style.color = 'red';
                        errorAlert.classList.add('show');
                    } else {
                        errorAlert.classList.remove('show');
                    }
                })
                .catch(error => console.error('Error checking email:', error));
        }
    });

    // Validate the form on submit
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const password = formData.get('password');
        const confirmPassword = formData.get('confirm_password');
        const username = formData.get('username');
        const email = formData.get('email');

        // Validate password
        if (!passwordRegex.test(password)) {
            errorAlert.textContent = '✘ Error: Password must contain at least one uppercase and one lowercase letter.';
            errorAlert.style.color = 'red';
            errorAlert.classList.add('show');
            return;
        }

        // Validate password match
        if (password !== confirmPassword) {
            errorAlert.textContent = '✘ Error: Passwords do not match.';
            errorAlert.style.color = 'red';
            errorAlert.classList.add('show');
            return;
        }

        // Submit form data to the server
        fetch('user_signup.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(result => {
                if (result.includes('success')) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Sign Up Successful! Redirecting to login...',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        form.reset();
                        window.location.href = '../LOGIN&SIGNUP/loginpage.php';
                    });
                } else if (result.includes('username_taken')) {
                    errorAlert.textContent = '✘ Error: Username is already taken.';
                    errorAlert.style.color = 'red';
                    errorAlert.classList.add('show');
                } else if (result.includes('email_taken')) {
                    errorAlert.textContent = '✘ Error: Email is already taken.';
                    errorAlert.style.color = 'red';
                    errorAlert.classList.add('show');
                } else {
                    errorAlert.textContent = '✘ Error: Something went wrong. Please try again.';
                    errorAlert.style.color = 'red';
                    errorAlert.classList.add('show');
                }
            })
            .catch(error => {
                errorAlert.textContent = '✘ Error: Request failed.';
                errorAlert.style.color = 'red';
                errorAlert.classList.add('show');
                console.error('Request failed:', error);
            });
    });
});
