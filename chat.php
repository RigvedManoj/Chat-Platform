<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:signup.php");
}
else {
$name=$_SESSION['username'];
}

if (isset($_GET['id']))
{
  $frnd=$_GET['id'];
}
$_SESSION['name']=$frnd;
$frnds[0]="";
$text[0]="";
?>
<html>
<head>
  <style>

  #input
  {
    position: fixed;
    bottom: 0px;
    left:5%;
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  #send
  {
    position: fixed;
    bottom: 0px;
    left:55%;
    background:lightblue;
  	border-radius: 4px;
  	width: 8em;
  	height: 3em;
      margin: 8px 0;
    cursor: pointer;
  }
  #language
  {
    position: fixed;
    bottom: 0px;
    left:63%;
    background:lightblue;
    border-radius: 4px;
    width: 8em;
    height: 3em;
      margin: 8px 0;
    cursor: pointer;
  }
  h2
{
  padding: 4px 450px;
display: inline-block;
  position: relative;
text-align: center;
}
  </style>
</head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href=decorate.css>
<body id="body">
  <ul>
    <h2><?php echo $frnd?></h2>
     <li>
         <a><?php echo $name?></a>
         <ul class="dropdown">
             <li><a href="signup.php">Log out</a></li>
             <li><a href="homepage.php">Homepage</a></li>
             <li><a href="find.php">Find Friends</a></li>
         </ul>
     </li>
  </ul>
  <input  type="text" id="input"></input>
  <button id="send" onclick="send()">send</button>
  <select id="language" onclick="language()" >
<option id='ru'value='ru'>RUSSIAN</option>
<option id='en'value='en'>ENGLISH</option>
<option id='bg'value='bg'>BULGARIAN</option>
<option id='fr'value='fr'>FRENCH</option>
<option id='sq'value='sq'>ALBANIAN</option>
<option id='ar'value= 'ar'>ARABIC</option>
<option id='da'value='da'>DANISH</option></select>
<br>
<div id="response"></div>
<footer><br><br><br><br></footer>
</body>
</html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var testing=[];
var frnd=<?php echo json_encode($frnd); ?>;
function start()
{
$.ajax({url: "retrieve.php?id="+frnd}).done(function(html){
  testing=html;
  console.log(testing[0]);
  $("#response").html(html);
});;
  listen();
}
start();
function listen()
		{
      window.scrollTo(0,document.body.scrollHeight);
			var xhttp;
		 xhttp = new XMLHttpRequest();
		 xhttp.onreadystatechange = function() {
		 if (this.readyState == 4 && this.status == 200) {
		  start();
		 }
   };
		 xhttp.open("GET", "server.php", true);
		 xhttp.send();
  }
function send()
{
  var x=document.createElement("DIV");

var name= <?php echo json_encode($name); ?>;
var text=document.getElementById('input').value;
document.getElementById('input').value="";
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.open("GET", "store.php?id="+text, true);
  xhttp.send();
}
</script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("elements", "1", {
packages: "keyboard"
});
function onload()
{
var kbd = new google.elements.keyboard.Keyboard(
['ru'],['input']);
}
function language()
{
var code=document.getElementById("language").value;
var kbd = new google.elements.keyboard.Keyboard(
[code],['input']);
}

google.setOnLoadCallback(onload);

</script>
