
<?php
$Err="";
session_start();
if(empty($_SESSION['username']))
{
  $_SESSION['username']=0;
}
if($_SESSION['username']==1) {
 $Err='incorrect email/ password please try again.' ;
}
$_SESSION['username'] =0;
$nameErr=$passErr=$emailErr="";
$a=$b=$c="";
$t1=$t2=$t3=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['pass'])) {
      $passErr = "Password is required";
    } else {
      $t1=1;
      $pass1 = test_input($_POST['pass']);
      $c=password_hash($pass1,PASSWORD_BCRYPT);
    }
if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  }
 else {
    $t2=1;
    $a = test_input($_POST["name"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$a)) {
       $t2=0;
    $nameErr = "Only letters and white space allowed";
  }
  }

  if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $t3=1;
      $b = test_input($_POST["email"]);
      if (!filter_var($b, FILTER_VALIDATE_EMAIL)) {
        $t3=0;
    $emailErr = "Invalid email format";
  }
    }
}

$servername = "localhost";
$username = "root";
$password = "AthlonY2";
$dbname = "Platform";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name,email,pass FROM SIGNUP";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name=$row["name"];
      $email=$row["email"];
      $pass=$row['pass'];
      if($email==$b)
    {
       $emailErr = "An id with this email already exists";
       $t3=0;
    }
    if($name==$a)
    {
      $t2=0;
      $nameErr = "This username is already taken";
    }
}
}
// prepare and bind
if($t1==1 and $t2==1 and $t3==1)
{
$stmt = $conn->prepare("INSERT INTO SIGNUP (name, pass, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $pass, $email);

// set parameters and execute
$name = $a;
$pass = $c;
$email = $b;
$stmt->execute();


// set parameters and execute
$_SESSION['username']=$name;
$stmt->close();
$sql = "CREATE TABLE $name(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
know INT(1) UNSIGNED,
chat TEXT NOT NULL,
reg_date TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  echo  "Table CHATS created successfully  ";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn);

$conn->close();
//echo "SIGNUP SUCCESFULL";
header("Location:loading.html");
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href=form.css>
</head>
<body>
  <div>
    <p class="error"></p>
  <form method="post" action="signup.php">
    <input type="text"  name="name" placeholder="UserName" onkeyup="showHint(this.value)">
       <p> <span id="txtHint"></span></p>
       <p class="error"> <?php echo $nameErr;?></p>
    <input type="text" name="email" placeholder="Email">
    <p class="error"> <?php echo $emailErr;?></p>
  <input type="password"  name="pass" placeholder="Password">
   <p class="error"> <?php echo $passErr;?></p>
  <p id="p3"><input type="submit" value="Sign Up"></p>
  </form>
  <p id="p1">Already a member?</p>
  <p class="error"> <?php echo $Err;?></p>
  <form method="post" action="login.php">
  <input type="text" name="email" placeholder="Email">
<input type="password"  name="pass" placeholder="Password">

<p id="p2"><input type="submit" value="Log In"></p>
</form>
</div>
<p id="demo"></p>
</body>
</html>
<script>
function showHint(str) {
  var xhttp;
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "check.php?q="+str, true);
  xhttp.send();
}
</script>
