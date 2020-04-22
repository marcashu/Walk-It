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
    <div class="dropdown">
        <form action='' method='GET' class="form">
            <label for='county'id="label">Route Search!</label>
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
            <button id="submit" type="submit" name="county-submit">Search</button>

<?php

if(isset($_GET['countyname']))
{
    $countyidentifier = $_GET['countyname'];

    $sql = "SELECT * FROM pathcoordinates;";
    $result = $conn->query($sql);

    $checker = "SELECT * FROM pathcoordinates WHERE countyid = $countyidentifier;";
    $checkerresult = $conn->query($checker);
    if  (mysqli_num_rows($checkerresult) == 0) {
        echo '<p>No Routes Available</p>';
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["countyid"] == $countyidentifier) {
                echo
                '<div class="flex-container">
                    <div class="item"><h3>'. $row["pathname"]. '</h3></div>
                    <div class="item"><h3>'. $row["tmestamp"]. '</h3></div>
                    <a class="item" href="/walkit/usermap.php?pathid='. $row["pathid"]. '"><h3 class="mapbutton">View</h3></a>
                </div>';
            }
        }
    }
    else{
        echo '<p>0 results</p>';
    }
}
else{
        echo '<p>Please Search</p>';
}
?>
</form>
</div>
</div>
</html>
</body>