<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walkitdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

header("Location: ../index.php");

$userid = $_SESSION['userid'];
$coords = $_GET['coords'];
$pathname = $_GET['pathName'];
$countyid = $_GET['countyid'];


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `pathcoordinates` (pathid, tmestamp, pathname, coords, userid, countyid) VALUES (NULL, current_timestamp(), '$pathname', '$coords', '$userid', $countyid);";

if ($conn->query($sql) === TRUE) {
    $data = array('success' => true); 
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    $data = array('success' => false);
}

echo json_encode($data);

$conn->close();
?>