const faqBoxes = document.querySelectorAll(".faq-box");
const searchInput = document.getElementById("search");
const expandAllBtn = document.getElementById("expand-all");
const collapseAllBtn = document.getElementById("collapse-all");

// Toggle FAQ items with animation when the icon is clicked
faqBoxes.forEach((box) => {
  const answer = box.querySelector(".faq-answer");
  const icon = box.querySelector(".icon");

  // Attach event listener to the icon for toggling
  icon.addEventListener("click", (e) => {
    // Prevent event bubbling so that clicking the icon doesn't toggle the entire box
    e.stopPropagation();

    box.classList.toggle("active");
    icon.textContent = box.classList.contains("active") ? "-" : "+";

    // Animate the answer box sliding open/close
    if (box.classList.contains("active")) {
      answer.style.maxHeight = answer.scrollHeight + "px";
    } else {
      answer.style.maxHeight = null;
    }

    saveFAQState(); // Save the state of the FAQ box
  });
});

// Expand all FAQs
expandAllBtn.addEventListener("click", () => {
  faqBoxes.forEach((box) => {
    box.classList.add("active");
    const answer = box.querySelector(".faq-answer");
    answer.style.maxHeight = answer.scrollHeight + "px";
    const icon = box.querySelector(".icon");
    icon.textContent = "-";
  });
  saveFAQState(); // Save state to localStorage
});

// Collapse all FAQs
collapseAllBtn.addEventListener("click", () => {
  faqBoxes.forEach((box) => {
    box.classList.remove("active");
    const answer = box.querySelector(".faq-answer");
    answer.style.maxHeight = null;
    const icon = box.querySelector(".icon");
    icon.textContent = "+";
  });
  saveFAQState(); // Save state to localStorage
});

// Search FAQ function
searchInput.addEventListener("keyup", () => {
  const searchValue = searchInput.value.toLowerCase();
  faqBoxes.forEach((box) => {
    const question = box
      .querySelector(".faq-question")
      .textContent.toLowerCase();
    if (question.includes(searchValue)) {
      box.style.display = "block";
    } else {
      box.style.display = "none";
    }
  });
});

// Save FAQ open/close state to localStorage
function saveFAQState() {
  const faqState = {};
  faqBoxes.forEach((box, index) => {
    faqState[index] = box.classList.contains("active");
  });
  localStorage.setItem("faqState", JSON.stringify(faqState));
}

// Load FAQ state from localStorage
function loadFAQState() {
  const faqState = JSON.parse(localStorage.getItem("faqState"));
  if (faqState) {
    faqBoxes.forEach((box, index) => {
      const answer = box.querySelector(".faq-answer");
      const icon = box.querySelector(".icon");
      if (faqState[index]) {
        box.classList.add("active");
        icon.textContent = "-";
        answer.style.maxHeight = answer.scrollHeight + "px";
      } else {
        box.classList.remove("active");
        icon.textContent = "+";
        answer.style.maxHeight = null;
      }
    });
  }
}

// Load the FAQ state on page load
window.onload = loadFAQState;

// Search FAQ function
searchInput.addEventListener("input", () => {
  const searchValue = searchInput.value.toLowerCase().trim();
  faqBoxes.forEach((box) => {
    const questionText = box
      .querySelector(".faq-question")
      .textContent.toLowerCase();
    // Show the box if the question includes the search term, otherwise hide it
    if (questionText.includes(searchValue)) {
      box.style.display = "block";
    } else {
      box.style.display = "none";
    }
  });
});
