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

document.addEventListener("DOMContentLoaded", () => {
  const section = document.querySelector(".mission-vision");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          section.classList.add("show");
        }
      });
    },
    { threshold: 0.2 } // Trigger when 20% of the section is visible
  );

  observer.observe(section);
});

function toggleChat() {
  const chatbox = document.getElementById("chatbox");
  if (chatbox.style.display === "none" || chatbox.style.display === "") {
    chatbox.style.display = "block";
  } else {
    chatbox.style.display = "none";
  }
}

function sendMessage(message) {
  const chatboxContent = document.getElementById("chatbox-content");
  const userMessage = document.createElement("p");
  userMessage.className = "user-message";
  userMessage.textContent = message;
  chatboxContent.appendChild(userMessage);
  scrollToBottom();

  setTimeout(() => {
    const botResponse = document.createElement("p");
    botResponse.className = "message";
    botResponse.textContent = `You chose: ${message}`;
    chatboxContent.appendChild(botResponse);
    scrollToBottom();
  }, 1000);
}

function handleUserInput() {
  const inputField = document.getElementById("userInput");
  const message = inputField.value.trim();

  if (message !== "") {
    sendMessage(message);
    inputField.value = "";
  }
}

function scrollToBottom() {
  const chatboxContent = document.getElementById("chatbox-content");
  chatboxContent.scrollTop = chatboxContent.scrollHeight;
}
