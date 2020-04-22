<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
<script src="JS/javascript.js"></script>
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

<div class="form-holder">
<form class="form">
    <label id="label">My Routes</label>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walkitdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userid = $_SESSION['userid'];
//echo "CURRENT USER: ". $userid. "<br>";

//$sql = "SELECT `pathname`, `coords` FROM pathcoordinates WHERE userid=1 VALUES();"

$sql = "SELECT * FROM pathcoordinates;";
$result = $conn->query($sql);

$checker = "SELECT * FROM pathcoordinates WHERE userid = $userid;";

$checkerresult = $conn->query($checker);
if  (mysqli_num_rows($checkerresult) == 0) {
    echo '<p>No Routes Available</p>';
}

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		//all routes on database
		//echo "<br>". $row["userid"]. "Pathname: ". $row["pathname"]. "Coords: ". $row["coords"]. "id: ". $row["userid"]. "<br>";

		//all of users personal routes
		if ($row["userid"] == $userid) {
			echo 
            '<div class="flex-container">
                <div class="item"><h3>' .$row["pathname"]. '</h3></div>
                <div class="item"><h3>'. $row["tmestamp"]. '</h3></div>
                <a class="item" href="/walkit/usermap.php?pathid='. $row["pathid"]. '"><h3 class="mapbutton">View</h3></a>
            </div>';
		}
	}
}
else{
	echo "0 results";
}
?>
</form>
</div>
</html>
</body>
