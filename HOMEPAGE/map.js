// Initialize the map and set its view to Barangay Kalawaan's coordinates
var map = L.map("map").setView([14.5512, 121.0869], 15); // Kalawaan, Pasig coordinates

// Add OpenStreetMap tiles
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Add a marker at Kalawaan, Pasig
L.marker([14.5512, 121.0869])
  .addTo(map)
  .bindPopup("<b>Barangay Kalawaan</b><br>Pasig City, Philippines")
  .openPopup();

var map = L.map("map").setView([14.5512, 121.0869], 15);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

L.marker([14.5512, 121.0869])
  .addTo(map)
  .bindPopup("<b>Barangay Kalawaan</b><br>Pasig City, Philippines")
  .openPopup();
