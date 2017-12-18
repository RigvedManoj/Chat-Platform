<?php
echo "help"; ?>
<script>
function reload()
{
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.open("GET", "testing1.php?, true);
  xhttp.send();
}
var a=setInterval(reload,5000);
</script>
