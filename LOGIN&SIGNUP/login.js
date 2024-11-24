document.getElementById("loginForm").addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent form from submitting and refreshing the page

  const formData = new FormData(this); // Get the form data
  const successAlert = document.getElementById("successAlert");
  const errorAlert = document.getElementById("errorAlert");

  // Clear previous alerts
  successAlert.classList.remove("show");
  errorAlert.classList.remove("show");

  // Send the form data to the PHP script for validation
  fetch("login.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.json()) // Expecting JSON response
      .then((result) => {
          // Check the result returned from the server and show appropriate alerts
          if (result.status === "success") {
              successAlert.textContent = "✔ Success! Login successful.";
              successAlert.classList.add("show");

              // Redirect to ADMIN.php after 3 seconds
              setTimeout(function () {
                  window.location.href = result.redirect;
              }, 3000);
          } else if (result.status === "invalid_password") {
              errorAlert.textContent = "✘ Error: Invalid password.";
              errorAlert.classList.add("show");
          } else if (result.status === "invalid_credentials") {
              errorAlert.textContent = "✘ Error: Username or email not found.";
              errorAlert.classList.add("show");
          } else {
              errorAlert.textContent = "✘ Error: Something went wrong. Please try again.";
              errorAlert.classList.add("show");
          }

          // Auto-hide alerts after 3 seconds
          setTimeout(() => {
              successAlert.classList.remove("show");
              errorAlert.classList.remove("show");
          }, 3000);
      })
      .catch((error) => {
          // Show error alert if the request failed
          errorAlert.textContent = "✘ Error: Unable to process your request.";
          errorAlert.classList.add("show");

          setTimeout(() => errorAlert.classList.remove("show"), 3000);
          console.error("Request failed:", error);
      });
});
