<!DOCTYPE HTML>
<html>
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
$_SESSION['name']=$frnd; ?>
<style>
body{
  background-image: url("download.jpg");
}
p{
  background-color: lightblue;
  width: 100px;
  display: block;
  padding: 10px 20px;
  border-radius: 20px;
}
#div1 {
    background-image: url("download (1).jpg");
    width: 600px;
    height: 600px;
   overflow-y: scroll;
    border: 5px solid black;
    padding: 5px;
    margin: 2px 350px;
}
#input
{
  position: fixed;
  bottom: 0px;
  left:25%;
  width: 50%;
  padding: 12px 20px;
  margin: 2px 0;
  display: inline-block;
  border: 1px solid black;
  border-radius: 4px;
  box-sizing: border-box;
}
#send
{
  position: fixed;
  bottom: 0px;
  left:75%;
  background:lightblue;
  border-radius: 4px;
  width: 8em;
  height: 3em;
    margin: 2px 0;
  cursor: pointer;
}
</style>
<body>
<div id="div1" style="border solid 1px;"></div>
<input type="text" autofocus id="input" name="submit">
<button id="send" onclick="send()">send</button>
</body>
<script>
function send()
{
  var z1 = document.createElement("P");
  var z2= document.createElement("BR");
  var t1=document.getElementById("input").value;
  var width=(t1.length)*100/13 +100%13;
  if(width>550)
  width=550;
  z1.style.width=width+"px";
  var t = document.createTextNode(t1);
  z1.appendChild(t);
  document.getElementById("input").value="";
  document.getElementById("div1").appendChild(z1);
  document.getElementById("div1").appendChild(z2);
    document.getElementById("input").focus();
    var objDiv = document.getElementById("div1");
objDiv.scrollTop = objDiv.scrollHeight;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var testing=[];
var frnd=<?php echo json_encode($frnd); ?>;
function start()
{
$.ajax({url: "retrieve.php?id="+frnd}).done(function(html){
testing=html;
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
var name= <?php echo json_encode($name); ?>;
var text=document.getElementById('input').value;
document.getElementById('input').value="";
var xhttp;
xhttp = new XMLHttpRequest();
xhttp.open("GET", "store.php?id="+text, true);
xhttp.send();
}
</script>
