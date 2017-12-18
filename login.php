
<?php
$servername = "localhost";
$username = "root";
$password = "AthlonY2";
$dbname = "Platform";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$c=$_POST['pass'];
$a=$_POST["email"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$sql = "SELECT name,email,pass FROM SIGNUP";
$result = $conn->query($sql);
$k=1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name=$row["name"];
      $email=$row["email"];
      $pass=$row['pass'];
      if($email==$a && password_verify($c,$pass))
    {
      $_SESSION['username'] = $name;
      $k=0;
     header("Location:loading.html");
      exit();
    }
    }
}
if($k==1)
{
$_SESSION['username'] = 1;
$conn->close();
sleep(3);
header("Location:signup.php");
  exit();
}
}
?>
