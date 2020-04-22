<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walkitdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pathid = $_GET['pathid'];

//print_r($pathid);

$sql = "SELECT * FROM `pathcoordinates` WHERE pathid = '$pathid'";
//$result = $conn->query($sql);

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$result = $row["coords"];

?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
<meta charset="utf-8">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<title>Map</title>
</head>

<body>
<!--NAVIGATION-->
<?php
  if (isset($_SESSION['userid'])) {
    echo '
    </div>
    <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <br>
    <br>
    <a href="index.php">Home</a>
    <a href="routecreator.php">Route Creator</a>
    <a href="userprofile.php">My Routes</a>
    <a href="allroutes.php">Route Search</a>
    <a href="usermap.php">Map</a>
    <a href="login.php">Logout</a>
    <a href="instructions.php">How to Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>';
  } else {
    echo '
    <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="index.php">Home</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="instructions.php">How to Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>';
  }

?>
  <section id="weather">
    <h1 id="weather heading">
        <div id="temp"></div>
        <div id="minutely"></div>
    </h1>
    <h2 id="weatherheading2"><div id="location"></div></h2>
  </section>
    <section>
      <div id="user-map"></div>
    </section>
</body>

<script>
	$( document ).ready(function() {
	  weather();
	  initMap();
	  console.log( "ready!" );
	});

	function initMap() {
		var stringcoords = `<?php echo $result; ?>`;
		var coords = JSON.parse(stringcoords);
		var map;
		console.log(coords);

		if (navigator.geolocation) {
	      navigator.geolocation.getCurrentPosition(function userLoc(position) {
	        var pos = {
	          lat: position.coords.latitude,
	          lng: position.coords.longitude
	        };

	        map = new google.maps.Map(document.getElementById('user-map'), {zoom: 22, center: pos});

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

	        //marker to be placed at user location
	        var marker = new google.maps.Marker({
	          position: pos,
	          map: map,
	          label: "Me"
	        });

	        //draw path
		    var path = new google.maps.Polyline({
	        	path: coords,
		        strokeColor: '#FF0000',
		        strokeOpacity: 1.0,
		        strokeWeight: 2
		    });

	      path.setMap(map);

	      }, function() {
	        handleLocationError(true, map.getCenter());
	      });
	    } else {
	      // Browser doesn't support Geolocation
	      handleLocationError(false, map.getCenter());
	    }
	    //console.log("User coords: " + userCoords);
	  }, 500)
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
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJXJLXr4iJrcv2L9nvQohpcuJvZdVNl4U&callback=initMap">
</script>
</html>