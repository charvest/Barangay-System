const slides = document.getElementById("slides");
const totalSlides = 10; // Total number of images
let currentSlide = 0;

function updateSlidePosition() {
  const offset = -currentSlide * 100; // Adjusted to use percentage
  slides.style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
  if (currentSlide < totalSlides - 1) {
    currentSlide++;
  } else {
    currentSlide = 0; // Reset to the first slide
  }
  updateSlidePosition();
}

function prevSlide() {
  if (currentSlide > 0) {
    currentSlide--;
  } else {
    currentSlide = totalSlides - 1; // Go to the last slide
  }
  updateSlidePosition();
}

// Automatically cycle through slides every 3 seconds
let autoSlide = setInterval(nextSlide, 5000);

// Pause slider on hover
slides.addEventListener("mouseover", () => clearInterval(autoSlide));

// Resume slider when mouse leaves
slides.addEventListener("mouseout", () => {
  autoSlide = setInterval(nextSlide, 3000);
});
