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

$userid = $_SESSION['userid'];
echo "CURRENT USER: ". $userid. "<br>";

//$sql = "SELECT `pathname`, `coords` FROM pathcoordinates WHERE userid=1 VALUES();"

$sql = "SELECT pathname, coords, userid, tmestamp FROM pathcoordinates;";
$result = $conn->query($sql);

$idBasedPaths = [];

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		//all routes on database
		//echo "<br>". $row["userid"]. "Pathname: ". $row["pathname"]. "Coords: ". $row["coords"]. "id: ". $row["userid"]. "<br>";

		//all of users personal routes
		if ($row["userid"] == $userid) {
			//echo $row["pathname"]. "<br>". $row["coords"]. "<br>". $row["userid"]. "<br>". $row["tmestamp"]. "<br>";
			$pathArray = [];
			array_push($pathArray, $row["pathname"], $row["coords"], $row["tmestamp"]);
			//print_r($pathArray);
			array_push($idBasedPaths, $pathArray);
			//exit();
		}
	}
}
else{
	echo "0 results";
}

print_r($idBasedPaths);

?>