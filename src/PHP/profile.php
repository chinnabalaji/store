<?php
// including the Welcome.php file 
include "Welcome.php";
//connecting to MySQL database..
$conn = mysql_connect("localhost","project","password");
$db = mysql_select_db("storage",$conn); 
// query for searching  user name with email address provided in mysql 
$user = "select Name from data where Email= '$f2'";
// storing the user name in a variable
$result = mysql_query($user);
// closing database
mysql_close($db);

?>

