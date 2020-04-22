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
    <a href="instructions.php">How to Use Walk It.</a>
    </div>

    <div id="profile-main">
    <div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>
    </div>
    <div class="logo-holder"><img src="Assets/twitter_header_photo_1.png" alt="Logo" class="logo"></div>
    </div>

    <div class="form-holder">
    <form class="form" action="includes/logout.inc.php" method="POST">
    <label for="logout-submit"><b>You are logged in</b></label>
    <button id="submit" type="submit" name="logout-submit">Logout</button>
    </form>';
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
        <div class="form">';
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "invalidusername") {
              echo '<p class="error">Invalid Username</p>';
            }
            elseif ($_GET['error'] == "wrongpassword") {
              echo '<p class="error">Incorrect Password</p>';
            }
            elseif ($_GET['error'] == "emptyfields") {
              echo '<p class="error">Please fill in all fields</p>';
            }
        }
        echo '
            <form action="includes/login.inc.php" method="POST">
            <label for="username"><b>Username</b></label>
            <input type="text" name="username" placeholder="Enter Username">
            <br>
            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password">
            <br>
            <button id="submit" type="submit" name="login-submit">Login</button>
            </form>
        </div>
    </div>
    </div>';
  }
?>

</html>
</body>