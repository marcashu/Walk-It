function initMap() {
  //Create map and itialize to world map
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 22});
  infoWindow = new google.maps.InfoWindow;

  var userCoords = [];
  var markerArray = [];
  var pathArray = [];

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
          markerArray.push(marker);
          console.log("marker placed");
        }

        //draw path
        var path = new google.maps.Polyline({
                path: userCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
              });
        path.setMap(map);
        pathArray.push(path);

        //clear markers and path
        document.getElementById("clear").onclick = function(){
          for (var i = 0; i < markerArray.length; i++) {
            markerArray[i].setMap(null);
          }
          for (var j = 0; j < pathArray.length; j++) {
            pathArray[i].setMap(null);
          }
          markerArray = [];
          pathArray = [];
          //console.log("Path Cleared");
        }
      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
    console.log(userCoords);
  }, 1000)
  //remove marker code
  //marker.setMap(null);
  
  //----------------------------------------
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
