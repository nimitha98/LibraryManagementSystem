<?php

$hostname = 'localhost';        
$dbname   = 'library'; 
$username = 'root';             
$password = '';                 
$con=mysqli_connect($hostname, $username, $password) or DIE('Connection to host is failed, perhaps the service is down!');
mysqli_select_db($con,$dbname) or DIE('Database name is not available!');

?>
