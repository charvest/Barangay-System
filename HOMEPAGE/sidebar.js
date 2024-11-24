document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("toggleBtn");

  // Check if elements are found
  if (!sidebar || !toggleBtn) {
    console.error("Sidebar or toggle button not found");
    return;
  }

  // Add a click event listener to the toggle button
  toggleBtn.addEventListener("click", function () {
    console.log("Toggle button clicked"); // Check if click event is triggered
    sidebar.classList.toggle("collapsed"); // Toggle the 'collapsed' class
    console.log(
      "Sidebar collapsed state:",
      sidebar.classList.contains("collapsed")
    );
  });
});
