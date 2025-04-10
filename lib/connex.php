<?php  
$connex = mysqli_connect("localhost", "root", "root", "TP_2_DANILO", '8888');  

// VERIFIER CONNECTION  
if (mysqli_connect_error()) {  
  echo "Failed to connect to MySQL: " . mysqli_connect_error();  
  exit();  
}  

// Set the character set for the connection  
mysqli_set_charset($connex, "utf8");  
?>  