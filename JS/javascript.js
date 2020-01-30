

function initMap() {
  //Create map and itialize to world map
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 22});
  infoWindow = new google.maps.InfoWindow;

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        console.log(pos);
        map.setCenter(pos);

        //The marker, positioned at user location
        var marker = new google.maps.Marker({position: pos, map: map});

      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }

  /*
  const interval = setInterval(function() {
  console.log("Locating user...")
    //Get user location
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        console.log(pos);

        //The marker, positioned at user location
        var marker = new google.maps.Marker({position: pos, map: map});

      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
  }, 5000)
  
  */
  //----------------------------------------

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

function path() {
  //Create new map and itialize to world map
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 22});
  infoWindow = new google.maps.InfoWindow;

  const interval = setInterval(function() {
    console.log("Locating user...")
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function locFinder(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        console.log(pos + "HI I WORK");

        //The marker, positioned at user location
        var marker = new google.maps.Marker({position: pos, map: map});

      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
  }, 5000)
}

path();

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
initMap();

// https://enlight.nyc/projects/weather/
