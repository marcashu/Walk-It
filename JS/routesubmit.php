<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walkitdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$coords = $_POST['coords'];
$userid = $_SESSION['userid'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$countyquery = $conn->query("SELECT county FROM counties;");
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Submit Route</title>
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="JS/javascript.js"></script>
</head>

<body>
<div id='form-holder' class="popup">
	<div id='form'>
		<form action='"JS/submitcoords.php"' method='POST'>
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

<?php
$pathname = $_POST['pathname'];
$pathcountyid = $_POST['countyid'];
$sql = "INSERT INTO `pathcoordinates` (`pathid`, `tmestamp`, `pathname`, `coords`, `userid`, `countyid`) VALUES (NULL, current_timestamp(), '$pathname', '$coords', '$userid', '$countyid');";

if ($conn->query($sql) === TRUE) {
    $data = array('success' => true); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $data = array('success' => false);
}


//echo json_encode($data);
$conn->close();
?>