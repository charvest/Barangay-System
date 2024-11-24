document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("toggleBtn");
  const overlay = document.getElementById("overlay");
  const menuItems = document.querySelectorAll(".menu-item");

  // Toggle sidebar and overlay
  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");
    overlay.classList.toggle("active");
  });

  // Close sidebar on overlay click
  overlay.addEventListener("click", function () {
    sidebar.classList.add("collapsed");
    overlay.classList.remove("active");
  });

  // Add hover effects dynamically
  menuItems.forEach((item) => {
    item.addEventListener("mouseenter", function () {
      item.classList.add("hovered");
    });

    item.addEventListener("mouseleave", function () {
      item.classList.remove("hovered");
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const menuItems = document.querySelectorAll(".menu-item");

  menuItems.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      if (sidebar.classList.contains("collapsed")) {
        item.setAttribute("data-show-tooltip", "true");
      }
    });

    item.addEventListener("mouseleave", () => {
      if (sidebar.classList.contains("collapsed")) {
        item.removeAttribute("data-show-tooltip");
      }
    });
  });
});
