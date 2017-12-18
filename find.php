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
$i=0;
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
      if($row["name"]!=$name)
    {  $frnd[$i]=$row["name"];
      $i++;
    }
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
     width: auto;
   }
   li:hover
   {
     color: #939393;
     width: auto;
   }
   </style>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href=decorate.css>
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
   <input autofocus type="search" onkeyup="search()" id="input"></input>
 </body>
<script>
var frnd= <?php echo json_encode($frnd); ?>;
var a=document.createElement("OL");
a.setAttribute("id", "myOL");
document.body.appendChild(a);
var i=0;
for(i=0;i<frnd.length;i++)
{
        var y = document.createElement("LI");
        y.setAttribute("id",i);
        var t1 = document.createTextNode(frnd[i]);
        y.appendChild(t1);
        document.getElementById("myOL").appendChild(y);
        var f1 = document.getElementById(i);
       f1.addEventListener("click",modify);

}

function modify(e)
{
  var id=e.target.id;
  var send=document.getElementById(id).innerHTML;
  window.location.href = "chat.php?id="+send;
}

function search()
{
  var z=document.getElementById("myOL");
  document.body.removeChild(z);
  var a=document.createElement("OL");
  a.setAttribute("id", "myOL");
  document.body.appendChild(a);
  var search=document.getElementById('input').value;
  i=0;
 for(i=0;i<frnd.length;i++)
 {
   if(frnd[i].indexOf(search) !== -1)
        { var y = document.createElement("LI");
         y.setAttribute("id",i);
         var t1 = document.createTextNode(frnd[i]);
         y.appendChild(t1);
         document.getElementById("myOL").appendChild(y);
         var f1 = document.getElementById(i);
        f1.addEventListener("click",modify);
 }
}
 }
</script>
