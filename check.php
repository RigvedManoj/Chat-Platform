<?php
$q = $_REQUEST["q"];
$servername = "localhost";
$username = "root";
$password = "AthlonY2";//enter mysql password
$dbname = "Platform";


$n=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name FROM SIGNUP";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name=$row["name"];
    if($name==$q)
    {
      $n=1;
      echo "taken";
      break;
    }
}
}
if($n==0)
{
  echo "available";
}
$conn->close();
?>
