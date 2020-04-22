//doc ready.
$( document ).ready(function() {
  weather();
  initMap();
  console.log( "ready!" );
});

document.getElementById("countyselect").onchange = function() {countyselecter()};

function countyselecter() {
  var e = document.getElementById("countyselect");
  var countyid = e.options[e.selectedIndex].value;
  console.log("countyid: " + countyid);

  return countyid;
}

function initMap() {
  //Create map and itialize to world map

  var userCoords = [];
  var markerArray = [];
  var pathArray = [];
  var idBasedPaths;
  var map;

  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function userLoc(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        map = new google.maps.Map(document.getElementById('map'), {zoom: 22, center: pos});
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

        //marker to be placed at user command and positioned at user location
        document.getElementById("draw").onclick = function() {
          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            draggable: true,
            label: "A"
          });
          userCoords.push(pos);
          markerArray.push(marker);
          console.log("Marker placed");

          //draw path
          var path = new google.maps.Polyline({
                  path: userCoords,
                  strokeColor: '#FF0000',
                  strokeOpacity: 1.0,
                  strokeWeight: 2
                });
          path.setMap(map);
          pathArray.push(path);
        }

        //clear markers and path
        document.getElementById("clear").onclick = function() {
          for (var i = 0; i < markerArray.length; i++) {
            markerArray[i].setMap(null);
          }
          for (var j = 0; j < pathArray.length; j++) {
            pathArray[j].setMap(null);
          }
          markerArray = [];
          pathArray = [];
          userCoords = [];
          usercoordstoredlats = [];
          usercoordstoredlongs = [];
          console.log("Path Cleared");
        }

        document.getElementById("save").onclick = function(){
          countyid = countyselecter();
          console.log("countyid: "+ countyid);
          
          if (userCoords.length < 2) {
            alert("Please place at least two markers to save!");
          }
          else if (userCoords.length >= 2) {
            var pathname = prompt("Please name your path");
            if ((pathname == null) || (pathname == "") || (pathname == " ")) {
              alert("Please enter a valid pathname");
            }
            else if ((!!pathname) || (pathname !== "") || (pathname !== " ")) {
              console.log("user coordinates" , userCoords);
              var json = JSON.stringify(userCoords);
              console.log(json);
              $.ajax({ 
                type: "GET", 
                url: "JS/submitcoords.php",
                data: { coords : json , pathName : pathname , countyid : countyid},
                dataType: 'json',
                success: function(data) { 
                  console.log(data);
                  if (data.success){
                    alert("mysql successfully inserted");
                  }
                  else{
                    alert("didnt work");
                  }
                }
              });
            }
          }
        }

      }, function() {
        handleLocationError(true, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, map.getCenter());
    }
    //console.log("User coords: " + userCoords);
  }, 500)
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
}

function openNav() {
  document.getElementById("mySidebar").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}

$('.hover_bkgr_fricc').click(function(){
  $('.hover_bkgr_fricc').hide();
});

$('.popupCloseButton').click(function(){
    $('.hover_bkgr_fricc').hide();
});

// https://enlight.nyc/projects/weather/
