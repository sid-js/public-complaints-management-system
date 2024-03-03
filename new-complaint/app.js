const defaultLocation = [12.97, 77.59];

var map = L.map('map').setView(defaultLocation, 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

let pickerMaker = L.marker(defaultLocation);

pickerMaker.addTo(map);

document.getElementById('latitude').value = defaultLocation[0];
document.getElementById('longitude').value = defaultLocation[1];
document.getElementById(
  'coordinates'
).textContent = `Latitude: ${defaultLocation[0]}, Longitude: ${defaultLocation[1]}`;

map.on('click', function (e) {
  setCoordinates(e.latlng);
  pickerMaker.setLatLng(e.latlng);
  map.setView(e.latlng);
});

map.on('mouseover', function () {
  document.getElementById('map').style.cursor = 'crosshair';
});

function setCoordinates(latlng) {
  console.log(latlng);
  document.getElementById('latitude').value = latlng.lat;
  document.getElementById('longitude').value = latlng.lng;
  document.getElementById(
    'coordinates'
  ).textContent = `Latitude: ${latlng.lat}, Longitude: ${latlng.lng}`;
}
