<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:signup.php");
}
else {
$name=$_SESSION['username'];
}
$servername = "localhost";
$username = "root";
$password = "AthlonY2";//enter mysql password
$dbname = "Platform";
if (isset($_GET['id']))
{
  $frnd=$_GET['id'];
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT name,know,chat FROM $name";
$result = $conn->query($sql);
$i=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row["name"]==$frnd)
  { $know=$row["know"];
    $text=$row["chat"];
    if($know==0)
    $send[$i]=$name.": ".$text."<br><br>";
    else {
      $send[$i]=$frnd.": ".$text."<br><br>";
    }
    echo $send[$i];
    $i++;
    }
}
}

 ?>
