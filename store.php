<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:signup.php");
}
else {
$nam=$_SESSION['username'];
$frnd=$_SESSION['name'];
}
$servername = "localhost";
$username = "root";
$password = "AthlonY2";//enter mysql password
$dbname = "Platform";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id']))
{
  $text1=$_GET['id'];
}
$stmt = $conn->prepare("INSERT INTO $nam (name,know,chat) VALUES (?,?,?)");
$stmt->bind_param("sss", $name1,$name2,$chat);
// set parameters and execute
$name1 = $frnd;
$name2 = 0;
$chat = $text1;
$stmt->execute();
$stmt->close();
$stmt = $conn->prepare("INSERT INTO $frnd (name,know,chat) VALUES (?,?,?)");
$stmt->bind_param("sss", $name1,$name2,$chat);
// set parameters and execute
$name1 = $nam;
$name2 = 1;
$chat = $text1;
$stmt->execute();
$stmt->close();
$conn->close();
$host    = "127.0.0.1";
$port    = 23019;
$send=$name1.":".$text1;
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
socket_write($socket, $send, strlen($send)) or die("Could not send data to server\n");
socket_close($socket);
?>
