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

  $countyquery = $conn->query("SELECT * FROM counties;");
?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
<meta charset="utf-8">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<title>index</title>
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


<!--NAVIGATION-->
<div id="middlesection">
  <div id="weather">
    <h1 id="weather heading">
        <div id="temp"></div>
        <div id="minutely"></div>
    </h1>
    <h2 id="weatherheading2"><div id="location"></div></h2>
  </div>

  <div class="dropdown">
    <form action='JS/submitcoords.php' method='GET'>
    <label for='county'><b>Please select your location</b></label>
    <br>
    <select name="countyname" id="countyselect">
      <?php
        while($rows = $countyquery->fetch_assoc()) {
          $county = $rows['county'];
          $countyid = $rows['countyid'];
          echo "<option value='$countyid' name='countyid'>$county</option>";
        }
      ?>
    </select>
    </form>
  </div>

  <div id="buttons">
    <a class="button" id="draw">Start</a>
    <a class="button" id="clear">Clear Map</a>
    <a class="button" id="save" type='submit' name='county-submit'>Save Route</a>
  </div>
</div>


<section>
  <div id="map"></div>
  </script>
</section>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNLQpGA4gKolCb56U8LpT4TjERBh3Pwhc&callback=initMap">
</script>
<script src="JS/javascript.js"></script>
</html> 
