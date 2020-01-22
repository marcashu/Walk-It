function map(a, b){
  var map = L.map('map').setView([a, b], 100);

  L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=MSG1AbUMXyiahW0ZtfiQ', {
      attribtution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
  }).addTo(map);
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
    map(latitude, longitude);
  }

  function error() {
    location.innerHTML = "Unable to retrieve your location";
  }

  location.innerHTML = "Locating...";
}

weather();

// https://enlight.nyc/projects/weather/