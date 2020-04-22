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
    <a href="routecreator.php">Route Creator</a>
    <a href="userprofile.php">My Routes</a>
    <a href="allroutes.php">Route Search</a>
    <a href="usermap.php">Map</a>
    <a href="login.php">Logout</a>
    <a href="instructions.php">How To Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>
    <div class="form-holder">
        <form class="form">
            <h2 class="instructions-title">Welcome to Walk It.</h2>
            <h3 class="instructions-h">With Walk It. you can create your very own walking routes and share them with everyone!</h3>
            <h3 class="instructions-h">If you get stuck or confused head over to the instruction page to find out how to operate the route creator</h3>
            
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
    <a href="instructions.php">How To Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>
    <div class="form-holder">
        <form class="form">
            <h2 class="instructions-title">Welcome to Walk It.</h2>
            <h3 class="instructions-h">With Walk It. you can create your very own walking routes and share them with everyone!</h3>
            <h3 class="instructions-h">If you get stuck or confused head over to the instruction page to find out how to operate the route creator</h3>
            
        </form>
    </div>
    </div>';
  }
?>

</html>
</body>