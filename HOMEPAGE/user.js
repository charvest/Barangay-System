function submitProfile() {
  const formData = new FormData(document.getElementById("profileForm"));
  let allFieldsFilled = true;
  let hasSpecialChars = false;

  // Pattern to check against HTML special characters
  const specialCharPattern = /[<>"'&]/;

 // Validate input fields
 document.querySelectorAll(".edit-mode").forEach((input) => {
  if (input.value.trim() === "") {
    allFieldsFilled = false;
  }
  // Check for special characters
  if (specialCharPattern.test(input.value)) {
    hasSpecialChars = true;
  }
  // Append each input to formData
  formData.append(input.name, input.value);
});

  // Display validation errors if needed
  if (!allFieldsFilled) {
    Swal.fire({
      icon: "warning",
      title: "Validation Error",
      text: "All fields are required.",
    });
    return;
  }


  if (hasSpecialChars) {
    Swal.fire({
      icon: "error",
      title: "Invalid Characters",
      text: "HTML special characters <, >, \", ', & are not allowed.",
    });
    return;
  }

  // Include the profile picture in the FormData if selected and check size
  const profilePictureInput = document.getElementById("profile_picture");
  if (profilePictureInput.files.length > 0) {
    const fileSize = profilePictureInput.files[0].size;
    if (fileSize > 2 * 1024 * 1024) { // 2MB limit
      Swal.fire({
        icon: "error",
        title: "File Too Large",
        text: "Profile picture must be less than 2MB.",
      });
      return;
    }
    formData.append("profile_picture", profilePictureInput.files[0]);
  }

  fetch("submit_profile.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data.status === "success") {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: data.message,
        }).then(() => {
          toggleEditMode(); // Switch back to view mode
          location.reload(); // Reload to refresh displayed data
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
        });
      }
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Network Error",
        text: "Failed to connect to the server. Please try again later.",
      });
      console.error("Error:", error);
    });
}


// Preview image function
function previewImage(event) {
  const preview = document.getElementById("profile-preview");
  preview.src = URL.createObjectURL(event.target.files[0]);
  preview.onload = () => URL.revokeObjectURL(preview.src);
}

// Toggle edit mode
function toggleEditMode() {
  const viewElements = document.querySelectorAll(".view-mode");
  const editElements = document.querySelectorAll(".edit-mode");
  const editBtn = document.getElementById("edit-btn");
  const updateBtn = document.getElementById("update-btn");

  viewElements.forEach(
    (el) => (el.style.display = el.style.display === "none" ? "inline" : "none")
  );
  editElements.forEach(
    (el) => (el.style.display = el.style.display === "none" ? "inline" : "none")
  );

  editBtn.style.display = editBtn.style.display === "none" ? "inline" : "none";
  updateBtn.style.display =
    updateBtn.style.display === "none" ? "inline" : "none";
}
