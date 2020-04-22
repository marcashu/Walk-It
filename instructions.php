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
<?php
  if (isset($_SESSION['userid'])) {
    echo '
    </div>
    <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <br>
    <br>
    <a href="index.php">Home</a>
    <a href="index.php">Route Creator</a>
    <a href="userprofile.php">My Routes</a>
    <a href="allroutes.php">Route Search</a>
    <a href="usermap.php">Map</a>
    <a href="instructions.php">How to Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>
    <div class="form-holder">
        <form class="form">
            <h2 class="instructions-title">How to Create a Route</h2>
            <h3 class="instructions-h">Step 1</h3>
            <p class="instructions-p">Once, registered log into your account.</p>
            <h3 class="instructions-h">Step 2</h3>
            <p class="instructions-p">Select the county you are currently in.</p>
            <h3 class="instructions-h">Step 3</h3>
            <p class="instructions-p">Place at least two markers, it is highly reccommended that you place a marker at any turn you take while walking.</p>
            <h3 class="instructions-h">Step 4</h3>
            <p class="instructions-p">Press the save button.</p>
            <h3 class="instructions-h">Step 5</h3>
            <p class="instructions-p">Finally Name your route in a way anybody that anyone will be able know what your route can be used for.</p>
            <h3 class="instructions-h">Step 6</h3>
            <p class="instructions-p">Thats all! You can now find your route on "My Routes" and "All Routes".</p>
        </form>
    </div>
    </div>';
  }
  else {
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
    </div>
    <div class="form-holder">
        <form class="form">
            <h2 class="instructions-title">How to Create a Route</h2>
            <h3 class="instructions-h">Step 1</h3>
            <p class="instructions-p">Once, registered log into your account.</p>
            <h3 class="instructions-h">Step 2</h3>
            <p class="instructions-p">Select the county you are currently in.</p>
            <h3 class="instructions-h">Step 3</h3>
            <p class="instructions-p">Place at least two markers, it is highly reccommended that you place a marker at any turn you take while walking.</p>
            <h3 class="instructions-h">Step 4</h3>
            <p class="instructions-p">Press the save button.</p>
            <h3 class="instructions-h">Step 5</h3>
            <p class="instructions-p">Finally Name your route in a way anybody that anyone will be able know what your route can be used for.</p>
            <h3 class="instructions-h">Step 6</h3>
            <p class="instructions-p">Thats all! You can now find your route on "My Routes" and "All Routes".</p>
        </form>
    </div>
    </div>';
  }
?>

</html>
</body>