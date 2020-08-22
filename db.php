<?php
// Enter your Host, username, password, database below.

include 'config.php';

$con = mysqli_connect($dbhost,$user,$pwd,$db);

if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
}
else{
  $conexec = new mysqli($dbhost,$user,$pwd,$db);
}

 ?>
