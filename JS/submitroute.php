<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walkitdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$countyquery = $conn->query("SELECT county FROM counties");
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Submit Route</title>
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="JS/javascript.js"></script>
</head>

<body>
<div id='form-holder'>
	<div id='form'>
		<form action='routesubmit.php' method='POST'>
		<label for="pathname"><b>Name your Path!</b></label>
        <input type="text" name="pathname" placeholder="Path name!">
        <br>
		<label for='county'><b>Please select the path's county</b></label>
		<br>
		<select name="countyname">
			<?php
				while($rows = $countyquery->fetch_assoc()) {
					$county = $rows['county'];
					$countyid = $rows['countyid'];
					echo "<option value='$countyid' name='countyid'>$county</option>";
				}
			?>
		</select>
		<br>
		<button id='submit' type='submit' name='path-submit'>Submit Path</button>
		</form>
	</div>
</div>
</body>