const defaultLocation = [12.97, 77.59];

var map = L.map('map').setView(defaultLocation, 11.4);

L.tileLayer(
  'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
  {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreeth</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 20,
  }
).addTo(map);

$(document).ready(function () {
  $.ajax({
    url: 'get-complaints.php', // PHP script to fetch data
    type: 'GET',
    success: function (response) {
      var data = JSON.parse(response);
      data.forEach(function (complaint) {
        var marker = L.marker([complaint.latitude, complaint.longitude]).addTo(
          map
        );
        marker.bindPopup(
          `<div class="popup-container">
              <h3 class="popup-title">${complaint.title}</h3>
              <div class="popup-description">${complaint.description}</div>
              <p class="popup-date"><strong>Date Reported:</strong> ${new Date(
                complaint.date
              ).toLocaleDateString()}</p>
              <p class="popup-status"><strong>Status:</strong> <span class="${complaint.status.toLowerCase()}">${
            complaint.status
          }</span></p>
          </div>`
        );
      });
    },
  });
});
