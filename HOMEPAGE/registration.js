document.addEventListener("DOMContentLoaded", () => {
  // Check if the user is logged in
  if (!isLoggedIn) {
      // Add the blurred class to the body
      document.body.classList.add("blurred");

      // Display an alert to the user
      Swal.fire({
          title: "Access Denied",
          text: "You need to log in to access this page.",
          icon: "warning",
          confirmButtonText: "OK"
      }).then(() => {
          // Redirect the user to the login page
          window.location.href = "../LOGIN&SIGNUP/loginpage.php";
      });
  }

  // Continue with the rest of the registration form logic if logged in
  const indigencyForm = document.getElementById("indigency-form");
  const clearanceForm = document.getElementById("clearance-form");
  const permitForm = document.getElementById("permit-form");

  function hideAllForms() {
      indigencyForm.classList.remove("active");
      clearanceForm.classList.remove("active");
      permitForm.classList.remove("active");
  }

  hideAllForms();
  indigencyForm.classList.add("active");

  document.getElementById("indigency-btn").addEventListener("click", () => {
      hideAllForms();
      indigencyForm.classList.add("active");
  });

  document.getElementById("clearance-btn").addEventListener("click", () => {
      hideAllForms();
      clearanceForm.classList.add("active");
  });

  document.getElementById("permit-btn").addEventListener("click", () => {
      hideAllForms();
      permitForm.classList.add("active");
  });

  // Sanitize form inputs to check for invalid characters
  function sanitizeInput(input) {
    if (input && input.value) {
        // Skip file inputs from sanitization, but still check them for invalid characters
        if (input.type === "file") {
            // Check if the file input has any invalid characters in its file name
            const invalidCharacters = /[&<>"'\/]/;
            const fileName = input.files[0]?.name || "";
            if (invalidCharacters.test(fileName)) {
                Swal.fire({
                    title: "Invalid File Name!",
                    text: "The following characters are not allowed in file names: & < > ' \" /",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                input.classList.add("error");
                input.focus();
                return false; // Invalid input
            }
            return true; // Valid file input (no need to sanitize file input value)
        }

        // Check for potentially dangerous characters in other types of inputs
        const invalidCharacters = /[&<>"'\/]/;
        if (invalidCharacters.test(input.value)) {
            Swal.fire({
                title: "Invalid Input!",
                text: "The following characters are not allowed: & < > ' \" /",
                icon: "error",
                confirmButtonText: "OK"
            });
            input.classList.add("error");
            input.focus();
            return false; // Invalid input
        }

        // If no invalid characters, sanitize the input
        input.value = input.value.replace(/[&<>"'/]/g, function (match) {
            const map = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;"
            };
            return map[match] || match;
        });
    }
    return true; // Valid input
}



    // Validate image upload (file size and type)
    function validateImageUpload(fileInput, maxSizeMB, allowedTypes) {
      const file = fileInput.files[0];
      if (!file) {
          return { valid: true }; // No file selected, no validation needed
      }

      const fileSizeMB = file.size / (1024 * 1024);
      const fileType = file.type.split("/")[1];

      if (fileSizeMB > maxSizeMB) {
          Swal.fire({
              title: "Error!",
              text: `File size exceeds ${maxSizeMB}MB. Please upload a smaller file.`,
              icon: "error",
              confirmButtonText: "OK"
          });
          return { valid: false };
      }

      if (!allowedTypes.includes(fileType)) {
          Swal.fire({
              title: "Error!",
              text: "Only .jpg, .jpeg, or .png files are allowed.",
              icon: "error",
              confirmButtonText: "OK"
          });
          return { valid: false };
      }

      return { valid: true };
  }

  // Setup file upload preview with validation
  function setupFileUpload(inputId, previewId, errorId) {
      const fileInput = document.getElementById(inputId);
      const filePreview = document.getElementById(previewId);
      const fileError = document.getElementById(errorId);
      const previewImg = filePreview.querySelector("img");

      fileInput.addEventListener("change", function () {
          const validation = validateImageUpload(fileInput, 3, ["jpg", "jpeg", "png"]);

          if (validation.valid) {
              const file = fileInput.files[0];
              fileError.textContent = ""; // Clear previous error message
              const reader = new FileReader();
              reader.onload = function (e) {
                  previewImg.src = e.target.result;
                  filePreview.style.display = "block";
              };
              reader.readAsDataURL(file);
          } else {
              filePreview.style.display = "none";
              fileError.textContent = "Invalid file. Please check the file size and type.";
          }
      });
  }
  // File preview setup for all forms
  setupFileUpload(
      "indigency-id-front",
      "indigency-preview-front",
      "indigency-error-front"
  );
  setupFileUpload(
      "indigency-id-back",
      "indigency-preview-back",
      "indigency-error-back"
  );
  setupFileUpload(
      "clearance-id-front",
      "clearance-preview-front",
      "clearance-error-front"
  );
  setupFileUpload(
      "clearance-id-back",
      "clearance-preview-back",
      "clearance-error-back"
  );
  setupFileUpload(
      "permit-id-front",
      "permit-preview-front",
      "permit-error-front"
  );
  setupFileUpload("permit-id-back", "permit-preview-back", "permit-error-back");

// Handle form submission via AJAX for Indigency form
indigencyForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  let valid = true;

  // Sanitize all inputs and check if any are invalid
  const inputs = indigencyForm.querySelectorAll("input, textarea, select");
  inputs.forEach(function (input) {
      if (!sanitizeInput(input)) {
          valid = false;
      }
  });

  // If any input is invalid, prevent form submission
  if (!valid) {
      Swal.fire({
          title: "Error!",
          text: "Please correct the invalid inputs.",
          icon: "error",
      });
      return; // Stop form submission
  }

  // Proceed with form submission via AJAX
  const formData = new FormData(indigencyForm);

  fetch("submit_indigency.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => {
          if (!response.ok) throw new Error("Network response was not ok");
          return response.json();
      })
      .then((data) => {
          if (data.status === "success") {
              Swal.fire({
                  title: "Good job!",
                  text: "Your information has been submitted!",
                  icon: "success",
              });
              indigencyForm.reset(); // Clear the form after success
              clearFilePreviews("indigency-preview-front", "indigency-preview-back"); // Clear file previews
          } else {
              Swal.fire({
                  title: "Error!",
                  text:
                      data.message ||
                      "There was an error submitting your form. Please try again.",
                  icon: "error",
              });
          }
      })
      .catch((error) => {
          Swal.fire({
              title: "Error!",
              text: "There was a problem with the server response.",
              icon: "error",
          });
          console.error("Error:", error);
      });
});


 // For Clearance Form submission
clearanceForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  let valid = true;

  // Sanitize all inputs for Clearance form
  const clearanceInputs = clearanceForm.querySelectorAll("input, textarea, select");
  clearanceInputs.forEach(function (input) {
      if (!sanitizeInput(input)) {
          valid = false;
      }
  });

  if (!valid) {
      Swal.fire({
          title: "Error!",
          text: "Please correct the invalid inputs.",
          icon: "error",
      });
      return; // Stop form submission
  }

  const formData = new FormData(clearanceForm);
  fetch("submit_clearance.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.json())
      .then((data) => {
          if (data.status === "success") {
              Swal.fire({
                  title: "Good job!",
                  text: "Your information has been submitted!",
                  icon: "success",
              });
              clearanceForm.reset(); // Clear the form after success
              clearFilePreviews("clearance-preview-front", "clearance-preview-back");
          } else {
              Swal.fire({
                  title: "Error!",
                  text:
                      data.message ||
                      "There was an error submitting your form. Please try again.",
                  icon: "error",
              });
          }
      })
      .catch((error) => {
          Swal.fire({
              title: "Error!",
              text: "There was a problem submitting your request.",
              icon: "error",
          });
          console.error("Error:", error);
      });
});

// For Permit Form submission
permitForm.addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  let valid = true;

  // Sanitize all inputs for Permit form
  const permitInputs = permitForm.querySelectorAll("input, textarea, select");
  permitInputs.forEach(function (input) {
      if (!sanitizeInput(input)) {
          valid = false;
      }
  });

  if (!valid) {
      Swal.fire({
          title: "Error!",
          text: "Please correct the invalid inputs.",
          icon: "error",
      });
      return; // Stop form submission
  }

  const formData = new FormData(permitForm);
  fetch("submit_permit.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.json())
      .then((data) => {
          if (data.status === "success") {
              Swal.fire({
                  title: "Good job!",
                  text: "Your information has been submitted!",
                  icon: "success",
              });
              permitForm.reset(); // Clear the form after success
              clearFilePreviews("permit-preview-front", "permit-preview-back");
          } else {
              Swal.fire({
                  title: "Error!",
                  text:
                      data.message ||
                      "There was an error submitting your form. Please try again.",
                  icon: "error",
              });
          }
      })
      .catch((error) => {
          Swal.fire({
              title: "Error!",
              text: "There was a problem submitting your request.",
              icon: "error",
          });
          console.error("Error:", error);
      });
});


  // Function to validate forms
  function validateForm(form) {
      const requiredFields = form.querySelectorAll("[required]");
      let valid = true;

      requiredFields.forEach((field) => {
          if (!field.value.trim()) {
              field.classList.add("error");
              valid = false;
          } else {
              field.classList.remove("error");
          }
      });

      return valid;
  }

  // Clear file preview images when form is reset
  function clearFilePreviews(...previewIds) {
      previewIds.forEach((id) => {
          const preview = document.getElementById(id);
          preview.style.display = "none";
      });
  }
});
