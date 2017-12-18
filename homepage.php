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
$password = "AthlonY2";
$dbname = "Platform";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT name,chat FROM $name";
$result = $conn->query($sql);
$i=0;
$frnds[0]='';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $frnds[$i]=$row["name"];
    $i++;
  }
}
 ?>
 <html>
 <head>
 <style>
 ol
 {
   list-style-type: circle;
 }
 li
 {
   cursor: pointer;
 }
 li:hover
 {
   color: #939393;
 }
 </style>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href=decorate.css>
 </head>
 <body id="body">
   <ul>
      <li>
          <a><?php echo $name?></a>
          <ul class="dropdown">
              <li><a href="signup.php">Log out</a></li>
              <li><a href="homepage.php">Homepage</a></li>
              <li><a href="find.php">Find Friends</a></li>
          </ul>
      </li>
   </ul>
   <p> YOUR CHATS:</p>
 </body>
<script>
var friends=<?php echo json_encode($frnds); ?>;
var i=0,check;
var a=document.createElement("OL");
a.setAttribute("id", "myOL");
document.body.appendChild(a);
while (i<friends.length)
{
  check=1;
  for(j=0;j<i;j++)
  {
    if(friends[j]==friends[i])
    { check=0;
      break;
    }
  }
  if(check==1)
  {
    var y = document.createElement("LI");
    var t1 = document.createTextNode(friends[i]);
    y.setAttribute("id",i);
    y.appendChild(t1);
    document.getElementById("myOL").appendChild(y);
    var f1 = document.getElementById(i);
   f1.addEventListener("click",modify);
  }
  i++;
}
function modify(e)
{
  var id=e.target.id;
  var send=document.getElementById(id).innerHTML;
  window.location.href = "chat.php?id="+send;
}
</script>
