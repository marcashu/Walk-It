function initMap() {
  //Create map and itialize to world map
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 22});
  infoWindow = new google.maps.InfoWindow;

  var userCoords = []

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function userLoc(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        console.log(pos);
        map.setCenter(pos);

        //first marker placed at user location
        var marker = new google.maps.Marker({
          position: pos,
          map: map,
          label: "Me"
          //icon: {
          //src: "http://maps.google.com/mapfiles/kml/paddle/red-circle.png"
          //}
        });
      }, function() {
        handleLocationError(true, map.getCenter());
      });
  } else {
    //error handling
    handleLocationError(false, map.getCenter());
  }

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

        //marker to be placed at user command and positioned at user location
        document.getElementById("draw").onclick = function(){
          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            draggable: true,
            label: "A"
          });

          userCoords.push(pos);
          console.log("marker placed");
        }

        document.getElementById("draw2").onclick = function(){
          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            draggable: true,
            label: "B"
          });
          console.log("marker placed");
        }
      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
  }, 5000)

  console.log(userCoords);
  //remove marker code
  //marker.setMap(null);
  
  //----------------------------------------

  var flightPlanCoordinates = [
    {lat: 37.772, lng: -122.214},
    {lat: 21.291, lng: -157.821},
    {lat: -18.142, lng: 178.431},
    {lat: -27.467, lng: 153.027}
  ];

  console.log(flightPlanCoordinates);

  var flightPath = new google.maps.Polyline({
          path: userCoords,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

  flightPath.setMap(map);
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
initMap();
// https://enlight.nyc/projects/weather/
