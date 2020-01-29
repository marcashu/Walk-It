/*function map(a, b){
  var map = L.map('map').setView([a, b], 100);

  L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=MSG1AbUMXyiahW0ZtfiQ', {
      attribtution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
  }).addTo(map);
}*/
function initMap() {
  //Get user location
  navigator.geolocation.getCurrentPosition(success, error);

  function error() {
    location.innerHTML = "Unable to retrieve your location";
  }

  function success(position) {
      latitude = position.coords.latitude;
      longitude = position.coords.longitude;
    
    var userLoc = {lat: latitude, lng: longitude};
    //Map centered at user location
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 16, center: userLoc});
    //The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: userLoc, map: map});

    var flightPlanCoordinates = [
      {lat: 37.772, lng: -122.214},
      {lat: 21.291, lng: -157.821},
      {lat: -18.142, lng: 178.431},
      {lat: -27.467, lng: 153.027}
    ];

    var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
          });

    flightPath.setMap(map);
  }
}

function weather() {
  var location = document.getElementById("location");
  var apiKey = "e1d1fae4bf442784686ab9e9f9238a52";
  var url = "https://api.forecast.io/forecast/";

  navigator.geolocation.getCurrentPosition(success, error);

  function success(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;

    location.innerHTML =
      "Latitude is " + latitude + "° Longitude is " + longitude + "°";

    $.getJSON(
      url + apiKey + "/" + latitude + "," + longitude + "?callback=?",
      function(data) {
        $("#temp").html(data.currently.temperature + "° F");
        $("#minutely").html(data.minutely.summary);
      }
    );
  }

  function error() {
    location.innerHTML = "Unable to retrieve your location";
  }

  location.innerHTML = "Locating...";
}

weather();
const interval = setInterval(function() {
  console.log("Locating user...")
  initMap();
 }, 5000)

//initMap();

// https://enlight.nyc/projects/weather/
