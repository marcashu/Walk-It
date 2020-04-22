<?php
  session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Register Form</title>
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
<script src="JS/javascript.js"></script>
</head>
<body>
<!--NAVIGATION-->
<?php
  if (isset($_SESSION['userid'])) {
    echo '
    <div id="mySidebar" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <br>
      <br>
      <a href="index.php">Home</a>
      <a href="index.php">Route Creator</a>
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
    <a href="instructions.php">How To Use Walk It.</a>
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
  <div class="form">
    <h1>Sign Up</h1>
    <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfields") {
          echo '<p class="signuperror">Please fill in all fields</p>';
        }
        elseif ($_GET['error'] == "invalidmail") {
          echo '<p class="signuperror">Please fill in a valid email</p>';
        }
        elseif ($_GET['error'] == "passwordcheck") {
          echo '<p class="signuperror">Passwords do not match</p>';
        }
        elseif ($_GET['error'] == "usertaken") {
          echo '<p class="signuperror">Username taken</p>';
        }
      }
      elseif (isset($_GET['signup'])) {
        echo '<p id="temp">Sign up successful!</p>';
      }
    ?>
    <form action="includes/signup.inc.php" method="POST">
      <input type="text" name="firstname" placeholder="First Name">
      <br>
      <input type="text" name="lastname" placeholder="Last Name">
      <br>
      <input type="text" name="username" placeholder="Username">
      <br>
      <input type="email" name="email" placeholder="Email">
      <br>
      <input type="password" name="password" placeholder="Password">
      <br>
      <input type="password" name="passwordrepeat" placeholder="Repeat Password">
      <br>
      <button id="submit" type="submit" name="signup-submit">Sign Up!</button>
    </form>
  </div>
</div>

</html>
</body>